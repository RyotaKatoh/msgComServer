var NUM = document.getElementById("numMessages").value;
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
 
function init(){
    var canvas = document.getElementById('tutorial');
        if (canvas.getContext){
            ctx = canvas.getContext('2d');
        for(var i = 0; i < NUM; i++){
        speedX[i] = Math.random() * 10.0 - 5.0;
        speedY[i] = Math.random() * 10.0 - 5.0;
        locX[i] = Math.floor(Math.random() * WIDTH);//WIDTH / 2;
        locY[i] = Math.floor(Math.random() * HEIGHT);//HEIGHT / 2;
        radius[i] = Math.random() * 34.0 + 30.0;
        r[i] = Math.floor(Math.random() * 255);
        g[i] = Math.floor(Math.random() * 255);
        b[i] = Math.floor(Math.random() * 255);
        message[i] = "Hello";
        }
        
        
        setInterval(draw, 33);
    }
    }
 
    function draw(){
    ctx.globalCompositeOperation = "source-over";
   
    ctx.fillStyle = "rgba(0,0,0,1.0)";
    ctx.fillRect(0, 0, WIDTH, HEIGHT);
 
 
    for(var i = 0; i < NUM; i++){
        //位置を更新
        locX[i] += speedX[i];
        locY[i] += speedY[i];
         
        if(locX[i] < 0 || locX[i] > WIDTH){
        speedX[i] *= -1.0;
        }
 
        if(locY[i] < 0 || locY[i] > HEIGHT){
        speedY[i] *= -1.0;
        }
         
        //更新した座標で円を描く
        ctx.beginPath();
        ctx.fillStyle = 'rgb(' + r[i] + ',' + g[i] + ',' + b[i] + ')';
        ctx.arc(locX[i], locY[i], radius[i], 0, Math.PI*2.0, true);
        ctx.fill();
        ctx.fillStyle = 'rgb(255,255,255)';
        ctx.textAlign   = "center";
        ctx.font         = 'Italic 30px Sans-Serif';
        ctx.fillText(message[i],locX[i],locY[i]);    
    }
}
    