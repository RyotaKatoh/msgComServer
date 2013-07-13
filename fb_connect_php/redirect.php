<?php
ini_set( 'display_errors', 1 );
require_once('../config.php');

session_start();

if(empty($_GET['code'])){
	// if use deny msgCom application
	if(isset($_GET['error'])){
		if($_GET['error'] == 'access_denied'){
			echo "Please permit...";
		
			echo "</br>";
			echo "<a href=\"login.php\">戻る</a>";
			exit;
		
		}
		exit;	
		
	}
	
	
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
	 
	 // DB processing
	 try{
	 		
	 	$dbh = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD);
		
	 }catch(PDOException $e){
	 	echo $e->getMessage();
		exit;
	 }
	 
	 $stmt = $dbh->prepare("SELECT * FROM user WHERE facebook_user_id=:user_id");
	 $stmt->execute(array(":user_id"=>$me->id));
	 $user = $stmt->fetch();
	 
	 //insert DB user information
	 if(empty($user)){
	 	echo "this is something wrong!!!";
		
		$stmt = $dbh->prepare("INSERT INTO user(facebook_user_id, facebook_name, facebook_picture, facebook_access_token, created, modified) VALUES (:user_id, :name, :picture, :token, now(), now())");
		
		$params = array(
			":user_id"=> $me->id,
			":name"=> $me->name,
			":picture"=> $me->picture->data->url,
			":token"=> $access_token
		);
		
		$stmt->execute($params);
		
		$stmt = $dbh->prepare("SELECT * from user WHERE id = :last_insert_id limit 1");
		$stmt->execute(array(":last_insert_id"=>$dbh->lastInsertId()));
		$user = $stmt->fetch();
		 
	 }
	 
	 if(!empty($user)){
	 	session_regenerate_id(true);
		$_SESSION['user'] = $user;
	 }	 
	 
	 //move to index.php
	 header('Location:http://ec2-54-248-86-228.ap-northeast-1.compute.amazonaws.com'."$_SESSION[page]");
	 
}

?>