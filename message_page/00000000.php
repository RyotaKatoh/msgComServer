<?php
require_once '../utility.php';
require_once '../config.php';
	
session_start();

$_SESSION['page'] = $_SERVER["SCRIPT_NAME"];

//check login
if(empty($_SESSION['user'])){

	header('Location:'.SITE_URL.'login.php');	
	
	exit;
}


//	 
try{
	$dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
		
}catch(PDOException $e){
	 echo $e->getMessage();
	exit;
}
	 
$stmt = $dbh->prepare("SELECT * FROM user_permission_to_messagepage WHERE facebook_user_id=:user_id AND page_name=:pagename");
$stmt->execute(array(":user_id"=>$_SESSION['user']['facebook_user_id'],
					  ":pagename"=>basename($_SERVER['SCRIPT_NAME'])));
$permission = $stmt->fetch();
if(empty($permission)){
	
	echo "You don not have permission this page";
	exit;
	
}

?>

<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="utf-8" />
    <title>Canvas tutorial template</title>
    
    <script type="text/javascript" src="../jquery.min.js"></script>
    <script>
    	function doAction(){
            $.getJSON('../getJson.php',callback);
        }
         
        function callback(result){
        	for(var i=0;i<result.length;i++){
        		
        		message[i] = result[i];
        		
        	}
            //$('#message').text('受信データ：' + result[id]);
        }
    	
    </script>
    
    <link type="text/css" rel="stylesheet" href="../common.css" />
    

  </head>
<body><!-- onload="init();">-->
	<div id="wrapper">

    <canvas id="tutorial"></canvas>
    
    <div id="params">
    	<input type="hidden" id="numMessages" value="<?php  numMessages();?>">
    	<input type="hidden" id="numImages"   value="<?php numImages();?>" >
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