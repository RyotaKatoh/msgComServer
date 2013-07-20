var NUM_MESSAGES = document.getElementById("numMessages").value;
var NUM_IMAGES = document.getElementById("numImages").value;
const WIDTH = innerWidth;
const HEIGHT = innerHeight; 
var speedX = new Array(NUM_MESSAGES);
var speedY = new Array(NUM_MESSAGES);
var locX = new Array(NUM_MESSAGES);
var locY = new Array(NUM_MESSAGES);
var radius = new Array(NUM_MESSAGES);
var r =  new Array(NUM_MESSAGES);
var g =  new Array(NUM_MESSAGES);
var b =  new Array(NUM_MESSAGES);
var ctx;

var message = new Array(NUM_MESSAGES);
var messageR = new Array(NUM_MESSAGES);
var messageG = new Array(NUM_MESSAGES);
var messageB = new Array(NUM_MESSAGES);

var image = new Array(NUM_IMAGES);
var imageLocX   = new Array(NUM_IMAGES);
var imageLocY   = new Array(NUM_IMAGES);
var imageSpeedX = new Array(NUM_IMAGES);
var imageSpeedY = new Array(NUM_IMAGES); 
 
function init(){
    var canvas = document.getElementById('tutorial');
        if (canvas.getContext){
            ctx = canvas.getContext('2d');
        	for(var i = 0; i < NUM_MESSAGES; i++){
        
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
       		$.getJSON("../getMessage.php",initMessage);
       		$.getJSON("../getImageID.php",initImage);
       		
    	}
}

function drawMessages(){
	for(var i = 0; i < NUM_MESSAGES; i++){
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
    	if(image[i]){
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
}
 
function draw(){
    ctx.globalCompositeOperation = "source-over";
   
    ctx.fillStyle = "rgba(0,0,0,1.0)";
    ctx.fillRect(0, 0, WIDTH, HEIGHT);
    
    drawImages();
    drawMessages();     
   
}

function initMessage(result){
	for(var i=0;i<result.length;i++){

		message[i] = result[i];

	}

}

function initImage(id){
	for(var i=0;i<id.length;i++){
		image[i] = new Image();
       	image[i].src = "../loadImage.php?id="+id[i];      			
       
  		imageSpeedX[i] = Math.random() * 8.0 - 4.0;
     	imageSpeedY[i] = Math.random() * 8.0 - 4.0;

		imageLocX[i] = Math.floor(Math.random() * (WIDTH - 500));
		imageLocY[i] = Math.floor(Math.random() * 120);    

	}
	
}

function checkUpdate(type){
	$.ajax({
  		type: "GET",
  		cache: false,
  		url: "../checkUpdate.php",
  		data:{
  			type: type
  		},
  		success: function(data){
			//messageの追加
			if(type == 'message' && data > NUM_MESSAGES){
				updateMessage(data);
			}
			//imageの追加
			else if(type == 'image' && data > NUM_IMAGES){
				updateImage(data);				
			}
  		},
  		error:function(data){
    		//alert(msg);
  		}
});

function updateMessage(numNewMessages){
	for(var i=NUM_MESSAGES;i<numNewMessages;i++){
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
        	
       	messageR[i] = 255 - r[i];
       	messageG[i] = 255 - g[i];
       	messageB[i] = 255 - b[i];
	}
	$.getJSON("../getMessage.php",function(result){
		for(var i=NUM_MESSAGES;i<result.length;i++){
			message[i] = result[i];
		}
		NUM_MESSAGES = numNewMessages;
	});
}

function updateImage(numNewImages){
	$.getJSON("../getImageID.php",function(id){
		for(var i=NUM_IMAGES;i<id.length;i++){
		image[i] = new Image();
       	image[i].src = "../loadImage.php?id="+id[i];      			
       
  		imageSpeedX[i] = Math.random() * 8.0 - 4.0;
     	imageSpeedY[i] = Math.random() * 8.0 - 4.0;

		imageLocX[i] = Math.floor(Math.random() * (WIDTH - 500));
		imageLocY[i] = Math.floor(Math.random() * 120);    

		}
		NUM_IMAGES = numNewImages;
	});
	
}

	
}
