<?php
require_once 'connectDB.php';
session_start();

mb_language("uni");
mb_internal_encoding("utf-8"); //内部文字コードを変更
mb_http_input("auto");
mb_http_output("utf-8");

//$sqlForMessage = sprintf('SELECT * FROM message');
$sqlForMessage = $dbh->prepare("SELECT COUNT(*) FROM message WHERE page_name = :page_name");
try{
	$sqlForMessage->execute(array(":page_name"=>$_SESSION['page_name']));
}catch(PDOException $e){
	$this->$dbh->rollback();
}
//$postsOfMessage = mysql_query($sqlForMessage) or die(mysql_error());

/*
$resultOfMessage = array();

while($row = mysql_fetch_assoc($postsOfMessage)):
	$resultOfMessage[] =  $row['message'];
endwhile;

 * 
 */
 
$sqlForImage = $dbh->prepare("SELECT COUNT(*) FROM image WHERE page_name=:page_name");
try{
	$sqlForImage->execute(array(":page_name"=>$_SESSION['page_name']));
}catch(PDOException $e){
	$this->$dbh->rollback();
}

//$postsOfImage = mysql_query($sqlForImage) or die(mysql_error());
/*
//DB内のメッセージをJSONの形式で返す
function createMessagesByJson(){
	global $resultOfMessage;

	header('Content-type:application/json; charset=utf8');
	echo json_encode($resultOfMessage);
}
 * 
 */

//DB内のメッセージ数を返す
function numMessages(){
	global $sqlForMessage;
	
	echo $sqlForMessage->fetchColumn();
	
}

//DB内の画像数を返す
function numImages(){
	global $sqlForImage;
	
	echo $sqlForImage->fetchColumn();
	
}


?>