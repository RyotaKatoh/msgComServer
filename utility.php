<?php
require_once 'join/dbconnection.php';

mb_language("uni");
mb_internal_encoding("utf-8"); //内部文字コードを変更
mb_http_input("auto");
mb_http_output("utf-8");

$sql = sprintf('SELECT * FROM message');

$posts = mysql_query($sql) or die(mysql_error());

mysql_close();

$result = array();

while($row = mysql_fetch_assoc($posts)):
	$result[] =  $row['message'];
endwhile;

//DB内のメッセージをJSONの形式で返す
function createMessagesByJson(){
	global $result;

	header('Content-type:application/json; charset=utf8');
	echo json_encode($result);
}

//DB内のメッセージ数を返す
function numMessages(){
	global $posts;
	
	echo mysql_num_rows($posts);
	
}

?>