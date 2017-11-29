<script src="../../bower_components/jquery/dist/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
        .chartWrapper {
            position: relative;         
        }

        .chartWrapper > canvas {
            position: absolute;
            left: 0;
            top: 0;
            pointer-events:none;
        }
.chartAreaWrapper {
          overflow-x: scroll;
            position: relative;
            width: 100%;
        }

        .chartAreaWrapper2 {  
            position: relative;
            height: 600px;
            max-height:600px
        }
    #myChart {max-height: 600px;}
    .container {
  width: 400px;
  height: 200px;
  position: absolute;
  top: 30%;
  left: 50%;
  overflow: hidden;
  text-align: center;
  transform: translate(-50%, -50%);
}

.gauge-a {
  z-index: 1;
  position: absolute;
  background-color: rgba(255,255,255,.2);
  width: 400px;
  height: 200px;
  top: 0%;
  border-radius: 250px 250px 0px 0px;
}

.gauge-b {
  z-index: 3;
  position: absolute;
  background-color: #222;
  width: 250px;
  height: 125px;
  top: 75px;
  margin-left: 75px;
  margin-right: auto;
  border-radius: 250px 250px 0px 0px;
}

.gauge-c {
  z-index: 2;
  position: absolute;
  background-color: #5664F9;
  width: 400px;
  height: 200px;
  top: 200px;
  margin-left: auto;
  margin-right: auto;
  border-radius: 0px 0px 200px 200px;
  transform-origin: center top;
  transition: all 1.3s ease-in-out;
}

.container:hover .gauge-c {  transform:rotate(.5turn);
}

.container:hover .gauge-data { color: rgba(255,255,255,1); }

.gauge-data {
  z-index: 4;
  color: rgba(255,255,255,.2);
  font-size: 1.5em;
  line-height: 25px;
  position: absolute;
  width: 400px;
  height: 200px;
  top: 90px;
  margin-left: auto;
  margin-right: auto;
  transition: all 1s ease-out;
}
</style>
<head></head>
<body>
    <div class="chartWrapper">
      <div class="chartAreaWrapper">
        <div class="chartAreaWrapper2" style="width: 800px; max-height:600px">
            <canvas id="myChart" max-height="600" height="600" width="800"></canvas>
        </div>
      </div>
        <canvas id="myChartAxis" height="300" width="0"></canvas>
    </div>
      <div id="gauges"></div>
      <div class="row">
      </div>
</body>
<script>
var data = [];
var data2 = [];
var counternum = 0;
var counter = [];
var temperature = [];
var fan = [];
var gpucount = 0;
function miners() {
	var socketStatus = document.getElementById('status');
	var socket = new WebSocket("ws://10.0.0.32:1880/ws/miner");
	socket.onopen = function(event) {
	  console.log('Connected to: ' + event.currentTarget.url);
	};
	socket.onerror = function(error) {
	  console.log('WebSocket Error: ' + error);
	};
	// Handle messages sent by the server.
	socket.onmessage = function(event) {
	  message = event.data;
      obj = JSON.parse(message);
      if (obj.id === 0) {
        counternum += 1;
        counter.push(counternum);
        newwidth = $('.chartAreaWrapper2').width() +60;
        $('.chartAreaWrapper2').width(newwidth);
        //$("#myChart").attr("width", newwidth);
        //$('.chartAreaWrapper').animate({scrollLeft:newwidth}); 
      }
        //$(".card-title").replaceWith("<span class='card-title'>"+obj.id+"</span>");
        divname = "#" + obj.id;
        toteth = obj.result[2];
        splittoteth = toteth.split(";");
        //VGA SEGRAGATION
        gpus = obj.result[3].split(";");
        //TEMP and FAN SEGRAGATION
        tempfan = obj.result[6].split(";");
        
        for (var i=0;i<tempfan.length;i++){
            if ((i+2)%2==0) {
                temperature = [obj.id, gpucount, tempfan[i]];
                //temperature.push(temparr);
                divgaugenamew = "temp" + obj.id + gpucount;
                divgaugename = "#" + divgaugenamew;
                if ($(divgaugename).length == 0){
                   $("#gauges").append("<div class='col s2 m2' id='temp"+obj.id + gpucount+"'>Miner: "+temperature[0]+"GPU: "+temperature[1]+" Temp: "+temperature[2]+"</div>"); 
                } else {
                    $(divgaugename).replaceWith("<div class='col s2 m2' id='temp"+obj.id + gpucount+"'>Miner: "+temperature[0]+" GPU: "+temperature[1]+" Temp: "+temperature[2]+"</div>");
                }
                gpucount += 1;
            }
            else {
                fanarr = [obj.id, tempfan[i]];
                fan.push(fanarr);
            }
        }

        totethhas = (splittoteth[0] / 1000).toFixed(3) + " MH/s";
        toteth = (splittoteth[0] / 1000).toFixed(3);
        totsia = obj.result[4];
        splittosia = totsia.split(";");
        totsiahash = (splittosia[0]/1000).toFixed(3) + " MH/s";
        if ($(divname).length == 0 ){
            $(".row").append("    <div id='"+obj.id+"' class='col s12 m6'>"
                            +"      <div class='card blue-grey darken-1 hoverable'>"
                            +"        <div class='card-content white-text'>"
                            +"          <span class='card-title'>Miner: "+obj.id+"</span>"
                            +"          <p>Running version: "+obj.result[0]+"</p><br>"
                            +"          <p>Total Hash Rate: "+totethhas+"</p><br>"
                            +"          <p>GPU1: "+(gpus[0]/1000).toFixed(3)+"MH/s, GPU2: "+(gpus[1]/1000).toFixed(3)+"MH/s, GPU3: "+(gpus[2]/1000).toFixed(3)+"MH/s, GPU4: "+(gpus[3]/1000).toFixed(3)+"MH/s, GPU5: "+(gpus[4]/1000).toFixed(3)+"MH/s, GPU6: "+(gpus[5]/1000).toFixed(3)+" MH/s</p><br>"
                            +"          <p>Total Number of Shares: "+splittoteth[1]+"</p><span>Rejected: "+splittoteth[2]+"<br>"
                            +"          <p>Total Sia Rate: "+totsiahash+"</p><br>"
                            +"          <p>Total Sia Shares: "+splittosia[1]+"</p><span>Rejected: "+splittosia[2]+"<br>"
                            +"        </div>"
                            +"        <div class='card-action'>"
                            +"          <a href='#'>This is a link</a>"
                            +"          <a href='#'>This is a link</a>"
                            +"        </div>"
                            +"      </div>"
                            +"    </div>");
        } else {
           $(divname).replaceWith("    <div id='"+obj.id+"' class='col s12 m6'>"
                            +"      <div class='card blue-grey darken-1 hoverable'>"
                            +"        <div class='card-content white-text'>"
                            +"          <span class='card-title'>Miner: "+obj.id+"</span>"
                            +"          <p>Running version: "+obj.result[0]+"</p><br>"
                            +"          <p>Total Hash Rate: "+totethhas+"</p><br>"
                            +"          <p>GPU1: "+(gpus[0]/1000).toFixed(3)+"MH/s, GPU2: "+(gpus[1]/1000).toFixed(3)+"MH/s, GPU3: "+(gpus[2]/1000).toFixed(3)+"MH/s, GPU4: "+(gpus[3]/1000).toFixed(3)+"MH/s, GPU5: "+(gpus[4]/1000).toFixed(3)+"MH/s, GPU6: "+(gpus[5]/1000).toFixed(3)+" MH/s</p><br>"
                            +"          <p>Total Number of Shares: "+splittoteth[1]+"</p><span>Rejected: "+splittoteth[2]+"<br>"
                            +"          <p>Total Sia Rate: "+totsiahash+"</p><br>"
                            +"          <p>Total Sia Shares: "+splittosia[1]+"</p><span>Rejected: "+splittosia[2]+"<br>"
                            +"        </div>"
                            +"        <div class='card-action'>"
                            +"          <a href='#'>This is a link</a>"
                            +"          <a href='#'>This is a link</a>"
                            +"        </div>"
                            +"      </div>"
                            +"    </div>");
        }
	 //HERE
        
        check = 0;
        for (i in window.myLine.data.datasets){
            vdataset = window.myLine.data.datasets[i];
            if (vdataset.label === obj.id) {
                check = 1;
            }
        }
        if (check === 1){
            for (i in window.myLine.data.datasets){
            vdataset = window.myLine.data.datasets[i];
            if (vdataset.label === obj.id) {
                vdataset.data.push(toteth);
            }
        }
        } else {
            backgroundcolor = getRandomRgb();
            //data2[obj.id].push(toteth);
            var newDataset = {
            backgroundColor: backgroundcolor,
            borderColor: backgroundcolor,
            borderWidth: 1,
            label: obj.id,
            fill: false
            }
            window.myLine.data.datasets.push(newDataset);
        }
    // You update the chart to take into account the new dataset
    window.myLine.update();
    gpucount = 0;
    };
}
miners();

var ctx = $("#myChart");
$( document ).ready(function(){
window.myLine = new Chart(ctx, {
    options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
               yAxes: [{
                display: true,
                position: 'right'
               }, {
                display: true,
                position: 'left'
               }]
             }
    },
    type: 'line',
    data: {
    labels: counter,
    datasets: []}
});
});
    
function getRandomRgb() {
    var num = Math.round(0xffffff * Math.random());
    var r = num >> 16;
    var g = num >> 8 & 255;
    var b = num & 255;
    return 'rgb(' + r + ', ' + g + ', ' + b + ')';
}
</script>