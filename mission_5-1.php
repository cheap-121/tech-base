<?php
//db接続
$dsn='mysql:dbname=データベース名;host=localhost';
$user='ユーザー名';
$pass='パスワード';
$pdo=new PDO($dsn,$user,$pass,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));
$error=0;

//投稿機能
if(!empty($_POST["comment"])||!empty($_POST["name"])){
	if(empty($_POST["editno"])){
  //フォームのデータ受け取り
	$name =$_POST["name"];
	$comment =$_POST["comment"];
  $date=date("Y-m-d H:i:s");
  $password=$_POST["password"];
	//データベースに入力
  $sql = $pdo -> prepare("INSERT INTO mission_5 (name, comment, updated_at, password) VALUES (:name, :comment, :updated_at, :password)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $comment, PDO::PARAM_STR);
  $sql -> bindParam(':updated_at', $date, PDO::PARAM_STR);
  $sql -> bindParam(':password', $password, PDO::PARAM_STR);
	$sql -> execute();
	$error=0;
 }
}

 //削除機能
 if(!empty($_POST["delete"])){
	 //フォームのデータ受け取り
	 $delete=$_POST["delete"];
	 $deletepass=$_POST["deletepass"];
	 //削除該当番号のパスワード取得
	 $sql='SELECT password from mission_5 where postnumber='.$delete;
	 $stmt = $pdo->query($sql);
	 $result = $stmt->fetch();
	 //パスワード合っていればデータベースから削除
  	if($result[0]==$deletepass){
  		$sql = 'delete from mission_5 where postnumber='.$delete;
  		$stmt = $pdo->prepare($sql);
  		$stmt->bindParam(':postnumber', $postnumber, PDO::PARAM_INT);
  		$stmt->execute();
			$error=0;
  	}
		else{
  		 $error=1;
  	 }
 }

 //編集機能(表示まで)
 if(!empty($_POST["edit"])){
	//フォームのデータ受け取り
	$edit=$_POST["edit"];
	$editpass=$_POST["editpass"];
	//編集該当番号のパスワード取得
	$sql='SELECT postnumber,name,comment,password from mission_5 where postnumber='.$edit;
	$stmt = $pdo->query($sql);
	$results = $stmt->fetch();
	//パスワード合っていれば投稿フォームに表示する変数とフラグを定義
	 if($results[3]==$editpass){
		 $editno=$results[0];
		 $editname=$results[1];
		 $editcomment=$results[2];
		 $hensyu=1;
		 $error=0;
	 }
	 else{
			$error=1;
			$hensyu=0;
		}
 }

 //編集機能（データベース書き換え）
 if(!empty($_POST["editno"])){
  //フォームのデータ受け取り
	$editno=$_POST["editno"];
	$editname=$_POST["name"];
	$editcomment=$_POST["comment"];
	$editdate=date("Y-m-d H:i:s");
	$editpassword=$_POST["password"];
 //データベース編集
	$sql = 'UPDATE mission_5 set name=:editname,comment=:editcomment,updated_at=:editdate,password=:editpassword where postnumber=:editno';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':editname', $editname, PDO::PARAM_STR);
	$stmt->bindParam(':editcomment', $editcomment, PDO::PARAM_STR);
  $stmt->bindParam(':editdate', $editdate, PDO::PARAM_STR);
  $stmt->bindParam(':editpassword', $editpassword, PDO::PARAM_STR);
	$stmt->bindParam(':editno', $editno, PDO::PARAM_INT);
	$stmt->execute();
	$error=0;
}

?>
<meta charset="uft-8">
<form action="#" method="post">
<p>
<input type="text" name="name" placeholder="名前" value="<?php if(!empty($edit)&&$hensyu==1){echo$editname;}?>">
</p>
<p>
<input type="text" name="comment" placeholder="コメント" value="<?php if(!empty($edit)&&$hensyu==1){echo$editcomment;}?>">
<input type="hidden" name="editno" value="<?php if(!empty($edit)&&$hensyu==1){echo$editno;}?>">
</p>
<p>
<input type="password" name="password" placeholder="パスワード">
<input type="submit" value="送信">
<p/>
</form>
<form action="#" method="post">
<p>
<input type="number" name="delete" placeholder="削除対象番号">
</p>
<p>
<input type="password" name="deletepass" placeholder="パスワード">
<input type="submit" value="削除">
</p>
</form>
<form action="#" method="post">
<p>
<input type="number" name="edit" placeholder="編集対象番号">
</p>
<p>
<input type="password" name="editpass" placeholder="パスワード">
<input type="submit" value="編集">
</p>
</form>

<?php
//エラーの表示
if($error==1){
	echo"パスワードが違います。";
	echo"<br>";
	echo"<hr>";
}
//テーブルのデータを表示
$sql = 'SELECT * FROM mission_5';
$stmt = $pdo->query($sql);
$results = $stmt->fetchAll();
foreach ($results as $row){
	echo $row['postnumber'].',';
	echo $row['name'].',';
	echo $row['comment'].',';
	echo $row['updated_at'].'<br>';
echo "<hr>";
}
 ?>
