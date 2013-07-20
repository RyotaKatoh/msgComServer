<?php

require_once 'connectDB.php';

//投稿処理
if(!empty($_POST)){
	if($_POST['message'] != ''){
		$sql = $dbh->prepare("INSERT INTO message (message, page_name) VALUES (:message,:page_name)");
		
		try{
			$sql->execute(array(":message"=>$_POST['message'],
								":page_name"=>$_POST['page_name']));
			
		}catch(PDOException $e){
			$this->$dbh->rollback();
		}
		
	}	
}

?>