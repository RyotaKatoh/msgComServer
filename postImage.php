<?php
require_once 'connectDB.php';

ini_set('default_charset', 'UTF-8');

/*
if(!isset($_POST['page_name'])){	
	exit;
}
 * 
 */

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

	//if you want to change picture quality change 3rd argument
	imagejpeg($newImage,$_FILES['image']['tmp_name'],100);
}

if(is_uploaded_file($path)){
	$mime = 'image/jpeg';
	//$tmpImage = './files/tmp.jpeg';
	$mime = addslashes($mime);

	$image = file_get_contents($path);
	
	if(empty($_POST['page_name'])){
		$sql = $dbh->prepare("INSERT INTO image (mime, image) values (:mime, :image)");
	
		try{
			$sql->execute(array(":mime"=>$mime,
								":image"=>$image));
		}catch(PDOException $e){
			$this->$dbh->rollBack();
		}
	}
	else{
		$sql = $dbh->prepare("INSERT INTO image (mime, image, page_name) values (:mime, :image, :page_name)");
	
		try{
			$sql->execute(array(":mime"=>$mime,
								":image"=>$image,
								":page_name"=>$_POST['page_name']));
		}catch(PDOException $e){
			$this->$dbh->rollBack();
		}
	}

	//$sql = "insert into image (mime, image, page_name) values ('$mime', '$data', 'messageCanvas.php')";
	//mysql_query($sql) or die(mysql_error());
	
}


?>
