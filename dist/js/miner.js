var gpucount = 0;
var minegputemp = [];
var socketStatus = document.getElementById('status');
var socket = new WebSocket("ws://10.0.0.32:1880/ws/miner");
function miners() {
	socket.onopen = function(event) {
	  console.log('Connected to: ' + event.currentTarget.url);
	};
	socket.onerror = function(error) {
	  console.log('WebSocket Error: ' + error);
	};
	// Handle messages sent by the server.
//	socket.onmessage = function(event) {
//    message = event.data;
//    obj = JSON.parse(message);     
//    tempfan = obj.result[6].split(";");
//    for (var i=0;i<tempfan.length;i++){
//            if ((i+2)%2==0) {
//                divgaugename = "temp" + obj.id + gpucount;
//                if (jQuery.inArray(divgaugename, minegputemp) == -1){
//                    minegputemp.push(divgaugename);
//                    blou = [divgaugename, parseInt(tempfan[i])];
//                    data.addRows([blou]);
//                } else {
//                    bla = data.getFilteredRows([{column: 0, value: divgaugename}]);
//                    data.setCell(bla[0], 1, parseInt(tempfan[i]));
////                    if (tempfan[i] >= 80){redplease(divgaugename);}
//                    redplease(divgaugename, tempfan[i]);
//                }
//                chart.draw(data, options);
//                if ($('table tbody tr td').hasClass("card")) {} else {
//                $('table tbody tr td').addClass("card blue-grey darken-1 hoverable col s3");
//                };
//                gpucount += 1;
//            }
//            else {}
//    }
//    gpucount = 0;
//    };
}