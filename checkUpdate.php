<?php

require_once 'connectDB.php';
session_start();

// type: message or image
if(!isset($_GET['type'])){
	exit;
}

if($_GET['type'] == 'message'){
	$sql = $dbh->prepare("SELECT COUNT(id) FROM message WHERE page_name=:page_name");
}
else if($_GET['type'] == 'image'){
	$sql = $dbh->prepare("SELECT COUNT(id) FROM image WHERE page_name=:page_name");
}

// データの取得
$sql->execute(array(":page_name"=>$_SESSION['page_name']));
 
// データを出力
print $sql->fetchColumn();


?>