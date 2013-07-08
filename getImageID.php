<?php
require_once 'join/dbconnection.php';

mb_language("uni");
mb_internal_encoding("utf-8"); //内部文字コードを変更
mb_http_input("auto");
mb_http_output("utf-8");

$sql = sprintf('SELECT id FROM image');

$imageID = mysql_query($sql) or die(mysql_error());

mysql_close();

$result = array();
while($row = mysql_fetch_assoc($imageID)):
	$result[] =  $row['id'];
endwhile;


header('Content-type:application/json; charset=utf8');
echo json_encode($result);
?>