<?php
require_once('../config.php');

session_start();

echo 
exit;

//check login
if(empty($_SESSION['user'])){
	//echo "session is not set";

	header('Location:'.SITE_URL.'login.php');	
	
	exit;
}

function h($e){
	
	return htmlspecialchars($e,ENT_QUOTES, "UTF-8");
	
}

// get friends data
$url = "https://graph.facebook.com/me/friends?access_token=".$_SESSION['user']['facebook_access_token'];
$friends = json_decode(file_get_contents($url));


?>

<!DOCTYPE html>
<html lang='ja'>
<head>
		<meta charset="UTF-8" />
		<title>Facebook Friend</title>
</head>

<body>
	<h1>Facebook Friend</h1>
	<?php echo session_id(); ?>
	
	<div>
		<img src="<?php echo h($_SESSION['user']['facebook_picture']); ?>">
		<p><?php echo h($_SESSION['user']['facebook_name']); ?>としてログインしています</p>
		<p><a href="logout.php">[logout]</a></p>
		<ul>
		<?php foreach ($friends->data as $friend) : ?>
    	<li><?php echo h($friend->name); ?></li>
    	<?php endforeach; ?>
    	</ul>
	</div>
</body>
</html>