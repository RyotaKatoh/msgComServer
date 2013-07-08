<?php
require_once 'join/dbconnection.php';

mb_language("uni");
mb_internal_encoding("utf-8"); //内部文字コードを変更
mb_http_input("auto");
mb_http_output("utf-8");

$sqlForMessage = sprintf('SELECT * FROM message');

$postsOfMessage = mysql_query($sqlForMessage) or die(mysql_error());

$resultOfMessage = array();

while($row = mysql_fetch_assoc($postsOfMessage)):
	$resultOfMessage[] =  $row['message'];
endwhile;

$sqlForImage = sprintf('SELECT * FROM image');
$postsOfImage = mysql_query($sqlForImage) or die(mysql_error());


mysql_close();
//DB内のメッセージをJSONの形式で返す
function createMessagesByJson(){
	global $resultOfMessage;

	header('Content-type:application/json; charset=utf8');
	echo json_encode($resultOfMessage);
}

//DB内のメッセージ数を返す
function numMessages(){
	global $postsOfMessage;
	
	echo mysql_num_rows($postsOfMessage);
	
}

//DB内の画像数を返す
function numImages(){
	global $postsOfImage;
	
	echo mysql_num_rows($postsOfImage);
	
}


?>