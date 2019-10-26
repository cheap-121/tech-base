<meta charset="uft-8">
<form action="mission_3-1.php" method="post">
<p>名前：
<input type="text" name="name">
</p>
<p>コメント：
<input type="text" name="comment">
<p/>
<input type="submit" value="送信">
</form>

<?php
$filename="mission_3-1.txt";
if(!empty($_POST["comment"])||!empty($_POST["name"])){
$comment=$_POST["comment"];
$name=$_POST["name"];
$time=date("Y年m月d日　H:i:s");
 if(file_exists($filename)){
 $postnumber=count(file($filename))+1;
 }
 else{
 $postnumber=1;
 }
$newdate=$postnumber."<>".$name."<>".$comment."<>".$time;

$fp=fopen($filename,"a");
fwrite($fp,$newdate."\n");
fclose($fp);

}
?>