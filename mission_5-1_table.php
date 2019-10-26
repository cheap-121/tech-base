<?php
//db接続
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$pass='パスワード';
$pdo=new PDO($dsn,$user,$pass,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));

//テーブル作成
$sql = "CREATE TABLE IF NOT EXISTS mission_5"
	." ("
	. "postnumber INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "comment TEXT,"
  . "updated_at DATETIME,"
  . "password TEXT"
	.");";
	$stmt = $pdo->query($sql);

?>
