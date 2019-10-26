<?php
//db接続
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$password='パスワード';
$pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));

//テーブル削除
$sql = "DROP TABLE mission_5";
	$stmt = $pdo->query($sql);

?>
