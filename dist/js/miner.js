var currenthost = window.location.hostname;
var deftemp = 80;
var maxhasheth = 200;
var gpucount = 0;
var minegputemp = [];
var socketStatus = document.getElementById('status');
var gaugediv = [];
var gaugedivdecred = [];
var g = [];
var gdecred = [];
var fanspattern = /^fan[0-9]+/;
var tempspattern = /^temperature[0-9]+/;
var ethratespattern = /^gpuethrate[0-9]+/;
var dcrratespattern = /^gpudcrrate[0-9]+/;
var ethrates =[];
var dcrrates = [];
var socket = new WebSocket("ws://"+currenthost+":1880/ws/socket");
function miners() {
	socket.onopen = function(event) {
	  console.log('Connected to: ' + event.currentTarget.url);
	};
	socket.onerror = function(error) {
	  console.log('WebSocket Error: ' + error);
	};
}

function gettemp(){
    if (parseInt($("#icon_prefix").val) != 0 ) {
   deftemp = $("#icon_prefix").val(); } 
    if (parseInt($("#maxhasheth").val) != 0 ) {
    maxhasheth = parseInt($("#maxhasheth").val()); 
    for (i=0; i < g.length; i++){
        g[i].refresh(g[i].originalValue, maxhasheth);
        }
    }
    if (parseInt($("#maxhashdecred").val) != 0 ) {
    maxhashdecred = parseInt($("#maxhashdecred").val()); 
    for (i=0; i < g.length; i++){
        gdecred[i].refresh(g[i].originalValue, maxhasheth);
        }
    }
};

function gage (evt, eth, dcr){
  g[evt] = new JustGage({
    id: gaugediv[evt],
    value: eth,
    min: 0,
    max: maxhasheth,
    title: "Total ETH rate"
    });
  gdecred[evt] = new JustGage({
    id: gaugedivdecred[evt],
    value: dcr,
    min: 0,
    max: 5000,
    title: "Total Decred rate"
    });
};
miners();