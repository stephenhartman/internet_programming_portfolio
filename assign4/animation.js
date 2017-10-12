var x = 0;
var sine = new Audio("sine2.ogg");
var timeInterval;

function init() {
	var canvas = document.getElementById("animation");
	if (canvas.getContext) {
		var ctx = canvas.getContext("2d");
		ctx.beginPath();
		ctx.moveTo(0,100);
		ctx.lineTo(900,100);
		ctx.stroke();
		ctx.beginPath();
		ctx.moveTo(0,0);
		ctx.lineTo(0,200);
		ctx.stroke();
		ctx.fillText("1", 5, 10);
		ctx.fillText("-1", 5, 200);
	}
	sine.play();
	drawWords();
	timeInterval = setInterval(function() {sineWave()}, 11);
}

function drawWords() {
	var canvasWords = document.getElementById("words");
	if (canvasWords.getContext) {
		var ctx = canvasWords.getContext("2d");
		ctx.fillStyle = "black";
		ctx.font = "24px calibri";
		var words1 = "   This is a sine wave. Sine waves occur naturally in wind, sound, and light waves, but they";
		var words2 = "          also generate alternating current for modern day electricity. The more you know!";
		var count = 0;
		var interval = 105;
		var characters1;
		var characters2;
		var lineheight = 15;
	}
	
	function draw() {
		count++;
		characters1 = words1.substr(0,count);
		characters2 = words2.substr(0, count);
		ctx.clearRect(0, 0, canvasWords.width, canvasWords.height);
		ctx.fillText(characters1, 0, 50);
		ctx.fillText(characters2, 0, 80);
		if (count < words1.length){
			setTimeout(draw, interval);
		}
	}
	draw();
}


function sineWave(){
	var canvas = document.getElementById("animation");
	if (canvas.getContext) {
		var ctx = canvas.getContext("2d");

		// y = sin(x)
		var y = Math.sin(x*Math.PI/180);
		
		if ( y >=0) {
			y = 100 - (y-0) * 100;
			ctx.fillStyle = "#37618A";
		}
		if ( y < 0 ) {
			y = 100 + (0-y) * 100;
			ctx.fillStyle = "#A1A9AC";
		}
		
		ctx.fillRect(x, y, Math.sin(x * Math.PI/180) * 5, Math.sin(x * Math.PI/180) * 5);
		x+=1;

		if(x > 900) {
			clearInterval (0);
		}
	}
}

function clearCanvas() {
	var canvas = document.getElementById("animation");
	var canvasWords = document.getElementById("words");
	var ctx1 = canvas.getContext("2d");
	var ctx2 = canvas.getContext("2d");
	ctx1.clearRect(0, 0, canvas.width, canvas.height);
	ctx2.clearRect(0, 0, canvasWords.width, canvasWords.height);
	x=0;
	clearInterval(timeInterval);
	init();
}