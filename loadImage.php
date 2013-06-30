<?php
/*
ini_set( 'display_errors', 1 );

require 'join/dbconnection.php';

$id = intval($_GET['id']);

$sql = "select * from image where id=$id";

if($images = mysql_query($sql))
{
	$image = mysql_fetch_assoc($images);
	header("Content-type: ".$image['mime']);
	echo stripslashes($image['image']);
}
 
 * 
 */
ini_set( 'display_errors', 1 );
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
<!--
<!DOCTYPE html>
<head>
	<title>test</title>
</head>

<body>
	<p><?php echo $image['id']; ?></p>
</body>