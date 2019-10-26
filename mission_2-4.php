<meta charset="uft-8">
<meta charset="uft-8">
<form action="" method="post">
<input type="text" name="comment" placeholder="コメント">
<input type="submit" value="送信">
</form>
<?php
if(!empty($_POST["comment"])){
$comment=$_POST['comment'];
$filename="mission_2-4.txt";
$fp=fopen($filename,"a");
fwrite($fp,$comment."\n");
fclose($fp);
$array=file($filename);
foreach($array as $komennto){
echo$komennto. "<br>";
}
}
?>