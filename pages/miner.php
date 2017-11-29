<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
/*    body {background-color: #263238;}*/
</style>
  <div class="card-panel blue-grey darken-1 hoverable" style="margin: 10px;">
        <div id="chart_div" style="width: 100%; height: 800px;"></div>
  </div>
  <div id="gauges"></div>
  <div class="row"></div>
<script>
var data = [];
var data2 = [];
var counternum = 0;
var counter = [];
var temperature = [];
var fan = [];
var gpucount = 0;
var googledata = [['Label', 'Value']];
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
                   $("#gauges").append("<div id='temp"+obj.id + gpucount+"' style=' display: none;'></div>"); 
//                    googledata.push([divgaugename, parseInt(tempfan[i])]);
//                    data = google.visualization.arrayToDataTable([[googledata]]);
                    blou = [divgaugename, parseInt(tempfan[i])];
                    data.addRows([blou]);
                } else {
//                    $(divgaugename).replaceWith("<div class='col s2 m2' id='temp"+obj.id + gpucount+"'>Miner: "+temperature[0]+" GPU: "+temperature[1]+" Temp: "+temperature[2]+"</div>");
                    bla = data.getFilteredRows([{column: 0, value: divgaugename}]);
                    data.setCell(bla[0], 1, parseInt(tempfan[i]));
                }
                chart.draw(data, options);
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
    gpucount = 0;
    };
}
miners();
google.charts.load('current', {'packages':['gauge']});
google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        options = {
//          width: 1000, height: 800,
          redFrom: 79, redTo: 100,
          yellowFrom:70, yellowTo: 79,
          minorTicks: 5
        };
//        data = google.visualization.arrayToDataTable([
//          ['Label', 'Value']
//        ]);
          
        data = new google.visualization.DataTable();
        data.addColumn('string', 'Miner/Fan');
        data.addColumn('number', 'value');


        chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        //chart.draw(data, options);
      }

function getRandomRgb() {
    var num = Math.round(0xffffff * Math.random());
    var r = num >> 16;
    var g = num >> 8 & 255;
    var b = num & 255;
    return 'rgb(' + r + ', ' + g + ', ' + b + ')';
}
</script>