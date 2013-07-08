<?php
ini_set( 'display_errors', 1 );
require_once('config.php');

session_start();

if(empty($_GET['code'])){
	// prepare authentification
	
	$_SESSION['state'] = sha1(uniqid(mt_rand(),TRUE));
	
	$params = array(
		'client_id' =>APP_ID,
		'redirect_uri' => SITE_URL.'redirect.php',
		'state' => $_SESSION['state'],
		'scope' => 'user_website, friends_website' 
	);
	
	$url = "https://www.facebook.com/dialog/oauth?".http_build_query($params);
    
	
	// move to facebook auth page.
	header('location:'.$url);
	
	exit;
}
else{
	
	if($_SESSION['state'] != $_GET['state']){
		echo "不正な処理！";
		exit;	
	}
	
	// get user information
	$params = array(
		'client_id' => APP_ID,
		'client_secret' => APP_SECRET,
		'code' => $_GET['code'],
		'redirect_uri' => SITE_URL.'redirect.php'
	);
	 $url = 'https://graph.facebook.com/oauth/access_token?'.http_build_query($params);
	 
	 $body = file_get_contents($url);
	 parse_str($body);
	 
	 $url = 'https://graph.facebook.com/me?access_token='.$access_token.'&fields=name,picture';
     $me = json_decode(file_get_contents($url));
     var_dump($me);
	 exit;
	
}

?>