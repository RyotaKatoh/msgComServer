
<?php
require 'join/dbconnection.php';

ini_set('default_charset', 'UTF-8');

if($_FILES['image']['error'])
	exit;

$mime = $_FILES['image']['type'];
$path = $_FILES['image']['tmp_name'];

if($mime == 'image/pjpeg') $mime  = 'image/jpeg';
if($mime == 'iamge/x-png') $mime  = 'image/png';

if(is_uploaded_file($path)){
	$mime = addslashes($mime);
	$data = addslashes(file_get_contents($path));
	
	$sql = "insert into image (mime, image) values ('$mime', '$data')";
	mysql_query($sql) or die(mysql_error());
	
}

/*  画像はDBに持たないで保存させる方法

require 'join/dbconnection.php';

function saveImageFileName($imageFileName){	
	$sql = sprintf('INSERT INTO image SET imageFileName="%s"', 
					mysql_real_escape_string($imageFileName));
	mysql_query($sql) or die(mysql_error());
}

ini_set('default_charset', 'UTF-8');
//投稿処理
if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
  if (move_uploaded_file($_FILES["image"]["tmp_name"], "files/".$_FILES["image"]["name"])) {
    	//アップロードされたファイルに権限付与
    	chmod("files/" . $_FILES["image"]["name"], 0666);
    	echo $_FILES["image"]["name"] . "をアップロードしました。";
		
		$imageFileName = sprintf("%s",$_FILES["image"]["name"]);

		saveImageFileName($imageFileName);

  } 
  else {
    echo "ファイルをアップロードできません。";
  }
}
else {
  echo "ファイルが選択されていません。";
}


?>
<p><a href="postImagePage.html">戻る</a></p>

<?php

require 'join/dbconnection.php';

//投稿処理
if(!empty($_POST)){
	if($_POST['message'] != ''){
		$sql = sprintf('INSERT INTO message SET message="%s"', 
						mysql_real_escape_string($_POST['message']));
		mysql_query($sql) or die(mysql_error());
		
	}	
}

//htmlspecialcharsのショートカット
function h($value){
	return htmlspecialchars($value,ENT_QUOTES,'utf-8');
}
 
 */

?>
