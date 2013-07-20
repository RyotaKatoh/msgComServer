<?php
require_once 'connectDB.php';
session_start();

mb_language("uni");
mb_internal_encoding("utf-8"); //内部文字コードを変更
mb_http_input("auto");
mb_http_output("utf-8");

//$sql = sprintf('SELECT id FROM image');
$sql = $dbh->prepare("SELECT id FROM image WHERE page_name=:page_name");

//$imageID = mysql_query($sql) or die(mysql_error());
try{
	$sql->execute(array(":page_name"=>$_SESSION['page_name']));
}catch(PDOException $e) { 
	$this->$dbh->rollBack();
}

$result = array();
while($row = $sql->fetch(PDO::FETCH_ASSOC)):
	$result[] =  $row['id'];
endwhile;


header('Content-type:application/json; charset=utf8');
echo json_encode($result);


?>