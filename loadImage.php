<?php

require 'connectDB.php';
session_start();

// 表示するイメージのIDをパラメータから取得
$id = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

//$sql = sprintf( 'SELECT * FROM image WHERE id = %d', $id );
$sql = $dbh->prepare("SELECT * FROM image WHERE id = :id AND page_name=:page_name");
try{
	
	$sql->execute(array(":id"=>$id,
						":page_name"=>$_SESSION['page_name']));
							
}catch(PDOException $e) { 
	$this->$dbh->rollBack();
}
 
// データの取得
$row = $sql->fetch(PDO::FETCH_ASSOC);
// 画像を出力
header( 'Content-Type: '.$row['mime'] );
print $row['image'];

?>