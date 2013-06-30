<?php
	require_once 'utility.php';
?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <title>Canvas tutorial template</title>
    
    <script type="text/javascript" src="./jquery.min.js"></script>
    <script>
    	function doAction(){
            $.getJSON('getJson.php',callback);
        }
         
        function callback(result){
        	for(var i=0;i<result.length;i++){
        		
        		message[i] = result[i];
        		
        	}
            //$('#message').text('受信データ：' + result[id]);
        }
    	
    </script>
    
    <link type="text/css" rel="stylesheet" href="common.css" />
    

  </head>
<body><!-- onload="init();">-->
	<div id="wrapper">

    <canvas id="tutorial"></canvas>
    
    <div id="params">
    	<input type="hidden" id="numMessages" value="<?php  numMessages();?>">
    	
    </div>
	</div>
   
   <script type="text/javascript" src="canvas.js"></script>
   <script>
	var canvas = document.getElementById('tutorial');

	function expandCanvas(){
    	var b = document.body;
    	var d = document.documentElement;
    	canvas.width = Math.max(b.clientWidth , b.scrollWidth, d.scrollWidth, d.clientWidth);
    	canvas.height = Math.max(b.clientHeight , b.scrollHeight, d.scrollHeight, d.clientHeight);
	}

	expandCanvas();
	doAction();
	init();
   
   </script>
 

   
</body>
</html>