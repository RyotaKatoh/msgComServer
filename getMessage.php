<?php
require_once 'join/dbconnection.php';

mb_language("uni");
mb_internal_encoding("utf-8"); //内部文字コードを変更
mb_http_input("auto");
mb_http_output("utf-8");

$sql = sprintf('SELECT * FROM message');// WHERE id=%d',
			//mysql_real_escape_string($_GET['id']));

$posts = mysql_query($sql) or die(mysql_error());

mysql_close();


$result = array();
while($row = mysql_fetch_assoc($posts)):
	$result[] =  $row['message'];
	//echo $row['message'];
endwhile;


header('Content-type:application/json; charset=utf8');
echo json_encode($result);