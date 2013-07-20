<?php

require 'join/dbconnection.php';

//投稿処理
if(!empty($_POST)){
	if($_POST['message'] != ''){
		$sql = sprintf('INSERT INTO message SET message="%s"', 
						mysql_real_escape_string($_POST['message']));
		mysql_query($sql) or die(mysql_error());
		
		header('Location: post.php');
		exit();
	}	
}

//htmlspecialcharsのショートカット
function h($value){
	return htmlspecialchars($value,ENT_QUOTES,'utf-8');
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html" charset=UTF-8 />
	<title>メッセージ投稿</title>
</head>

<body>
	<div id="wrap">
		<div id="head">
			<h1>メッセージ投稿画面</h1>
		</div>
		<div id="content">
			<form action="" method="post">
				<dl>
					<dt>メッセージをどうぞ</dt>
					<dd>
						<textarea name="message" cols="50" rows="5"><?php echo h($message); ?></textarea>
					</dd>
				</dl>
				
				<input type="submit" value="投稿する" />
				
			</form>
		</div>
		
		<div id="foot">
			<p>Copyright 2013 加藤 亮太. All Rights Reserved.</p>
		</div>
	</div>
</body>

</html>