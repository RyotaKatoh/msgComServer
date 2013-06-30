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

?>