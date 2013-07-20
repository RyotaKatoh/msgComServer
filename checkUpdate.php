<?php

require 'join/dbconnection.php';

// type: message or image
if(!isset($_GET['type'])){
	exit;
}

if($_GET['type'] == 'message'){
	$sql = sprintf('SELECT id FROM message');
}
else if($_GET['type'] == 'image'){
	$sql = sprintf( 'SELECT id from image');
}

// データの取得
$result = mysql_query( $sql );
 
// データを出力
print mysql_num_rows($result);

?>