var NUM = document.getElementById("numMessages").value;
var NUM_IMAGES = document.getElementById("numImages").value;
const WIDTH = innerWidth;
const HEIGHT = innerHeight; 
var speedX = new Array(NUM);
var speedY = new Array(NUM);
var locX = new Array(NUM);
var locY = new Array(NUM);
var radius = new Array(NUM);
var r =  new Array(NUM);
var g =  new Array(NUM);
var b =  new Array(NUM);
var ctx;

var message = new Array(NUM);
var messageR = new Array(NUM);
var messageG = new Array(NUM);
var messageB = new Array(NUM);

var image = new Array(NUM_IMAGES);
//var image = new Image();
//var image2 = new Image();
var imageLocX   = new Array(NUM_IMAGES);
var imageLocY   = new Array(NUM_IMAGES);
var imageSpeedX = new Array(NUM_IMAGES);
var imageSpeedY = new Array(NUM_IMAGES); 
 
function init(){
    var canvas = document.getElementById('tutorial');
        if (canvas.getContext){
            ctx = canvas.getContext('2d');
        	for(var i = 0; i < NUM; i++){
        
        		speedX[i] = Math.random() * 8.0 - 4.0;
        		speedY[i] = Math.random() * 8.0 - 4.0;
        		radius[i] = Math.random() * 34.0 + 30.0;
        		do{
        			locX[i] = Math.floor(Math.random() * WIDTH);//WIDTH / 2;
        		}while(locX[i]-radius[i] < 0 || locX[i] + radius[i] > WIDTH);
        		do{
        			locY[i] = Math.floor(Math.random() * HEIGHT);//HEIGHT / 2;
        		}while(locY[i] - radius[i] < 0 || locY[i] + radius[i] > HEIGHT);
        		r[i] = Math.floor(Math.random() * 255);
        		g[i] = Math.floor(Math.random() * 255);
        		b[i] = Math.floor(Math.random() * 255);
        		//message[i] = "Hello";
        		messageR[i] = 255 - r[i];
        		messageG[i] = 255 - g[i];
        		messageB[i] = 255 - b[i];
       		}
       		
       		$.getJSON("getImageID.php",initImage);
       		//initImage();
    	}
}

function drawMessages(){
	for(var i = 0; i < NUM; i++){
        //位置を更新
        locX[i] += speedX[i];
        locY[i] += speedY[i];
         
        if((locX[i] - radius[i]) < 0 || (locX[i] + radius[i]) > WIDTH){
        speedX[i] *= -1.0;
        }
 
        if((locY[i] - radius[i]) < 0 || (locY[i]+ radius[i]) > HEIGHT){
        speedY[i] *= -1.0;
        }
         
        //更新した座標で円を描く
        ctx.beginPath();
        ctx.fillStyle = 'rgb(' + r[i] + ',' + g[i] + ',' + b[i] + ')';
        ctx.arc(locX[i], locY[i], radius[i], 0, Math.PI*2.0, true);
        ctx.fill();
        ctx.fillStyle = 'rgb('+ messageR[i] +','+ messageG[i] + ','+ messageB[i] +')';
        ctx.textAlign   = "center";
        ctx.font         = 'Italic 20px Sans-Serif';
        ctx.fillText(message[i],locX[i],locY[i]);   
    }
}

function drawImages(){
    for(var i=0;i<NUM_IMAGES;i++){
    	imageLocX[i] += imageSpeedX[i];
    	imageLocY[i] += imageSpeedY[i];
    	
    	if((imageLocX[i] ) <0 || (imageLocX[i] + image[i].width)>WIDTH){
    		imageSpeedX[i] *= -1.0;
    	}
    	
    	if((imageLocY[i] )<0 || (imageLocY[i] + image[i].height) > HEIGHT){
    		imageSpeedY[i] *= -1.0;
    	}
    	
    	if(image[i].width > 0)
	    	ctx.drawImage(image[i],imageLocX[i],imageLocY[i]);
    	
    }	
}
 
function draw(){
    ctx.globalCompositeOperation = "source-over";
   
    ctx.fillStyle = "rgba(0,0,0,1.0)";
    ctx.fillRect(0, 0, WIDTH, HEIGHT);
    
    drawImages();
    drawMessages();     
   
}

function initImage(id){
	for(var i=0;i<id.length;i++){
		image[i] = new Image();
       	image[i].src = "loadImage.php?id="+id[i];      			
       
  		imageSpeedX[i] = Math.random() * 8.0 - 4.0;
     	imageSpeedY[i] = Math.random() * 8.0 - 4.0;

		imageLocX[i] = Math.floor(Math.random() * (WIDTH - 240));
		imageLocY[i] = Math.floor(Math.random() * 120);
/*
        do{
        	imageLocX[i] = Math.floor(Math.random() * WIDTH);
        }while(imageLocX[i] < 0 || (imageLocX[i]+image[i].width) > WIDTH);
        do{
        	imageLocY[i] = Math.floor(Math.random() * HEIGHT);
        }while(imageLocY[i] < 0 || (imageLocY[i]+image[i].height) > HEIGHT);
*/      

	}
	
	setInterval(draw, 33);
}
    