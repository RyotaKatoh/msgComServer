<?php

require 'join/dbconnection.php';

// 表示するイメージのIDをパラメータから取得
$id = isset( $_GET['id'] ) ? intval( $_GET['id'] ) : 0;

$sql = sprintf( 'SELECT * FROM image WHERE id = %d', $id );
 
// データの取得
$result = mysql_query( $sql );
$row = mysql_fetch_array( $result, MYSQL_ASSOC );
 
// 画像を出力
header( 'Content-Type: '.$row['mime'] );
print $row['image'];

?>