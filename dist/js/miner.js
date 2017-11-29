var currenthost = window.location.hostname;
var gpucount = 0;
var minegputemp = [];
var socketStatus = document.getElementById('status');
var socket = new WebSocket("ws://"+currenthost+":1880/ws/miner");
function miners() {
	socket.onopen = function(event) {
	  console.log('Connected to: ' + event.currentTarget.url);
	};
	socket.onerror = function(error) {
	  console.log('WebSocket Error: ' + error);
	};
}
miners();