<?php
require 'join/dbconnection.php';

ini_set('default_charset', 'UTF-8');

if($_FILES['image']['error']){

	exit;
}
	

$mime = $_FILES['image']['type'];
$path = $_FILES['image']['tmp_name'];

if($mime == 'image/pjpeg') $mime  = 'image/jpeg';
if($mime == 'image/x-png') $mime  = 'image/png';

$imginfo = getimagesize($path);
if($imginfo[2] == IMAGETYPE_JPEG || $imginfo[2] == IMAGETYPE_GIF || $imginfo[2] == IMAGETYPE_PNG){
	if($mime == 'image/png')
		$image = imagecreatefrompng($path);
	else if($mime == 'image/jpeg')
		$image = imagecreatefromjpeg($path);
	$width = $imginfo[0];
	$height= $imginfo[1];
	
	$newWidth = 240;
	$rate = $newWidth / $width;
	$newHeight = $rate*$height;
	
	global $newImage;
	$newImage = imagecreatetruecolor($newWidth, $newHeight);
	
	imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
	//imagejpeg($newImage,"./files/tmp.jpeg",100);
	imagejpeg($newImage,$_FILES['image']['tmp_name'],100);
}

if(is_uploaded_file($path)){
	$mime = 'image/jpeg';
	//$tmpImage = './files/tmp.jpeg';
	$mime = addslashes($mime);
	$data = addslashes(file_get_contents($path));
	//$data = addslashes(file_get_contents($tmpImage));
	
	$sql = "insert into image (mime, image) values ('$mime', '$data')";
	mysql_query($sql) or die(mysql_error());
	

	
}


?>
