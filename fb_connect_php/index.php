<?php
require_once('config.php');

session_start();

//check login
if(empty($_SESSION['user'])){

	header('Location:'.SITE_URL.'login.php');	
	exit;
}


?>

<!DOCTYPE html>
<html lang='ja'>
<head>
		<meta charset="UTF-8" />
		<title>Facebook Friend</title>
</head>

<body>
	<h1>Facebook Friend</h1>
</body>
</html>