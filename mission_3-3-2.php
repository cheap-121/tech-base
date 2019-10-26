<meta charset="uft-8">
<form action="mission_3-3-2.php" method="post">
<p>
<input type="text" name="name" placeholder="名前">
</p>
<p>
<input type="text" name="comment" placeholder="コメント">
<input type="submit" value="送信">
<p/>
</form>
<form action="mission_3-3-2.php" method="post">
<p>
<input type="number" name="delete" placeholder="削除対象番号">
<input type="submit" value="削除">
</p>
</form>




<?php
if(!empty($_POST["comment"])||!empty($_POST["name"])||!empty($_POST["delete"])){
//post
 $filename="mission_3-3-2.txt";
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
 $delete=$_POST["delete"];




//投稿ｐｈｐ
if(!empty($_POST["comment"])||!empty($_POST["name"])){

  //ファイル書き込み
  $fp=fopen($filename,"a");
  fwrite($fp,$newdate."\n");
  fclose($fp);

  //ブラウザ表示
  $array=file($filename);
  foreach($array as $filename){
  $newdate=explode("<>",$filename);
  echo$newdate[0]. " ";
  echo$newdate[1]. " ";
  echo$newdate[2]. " ";
  echo$newdate[3]. " ";
  echo"<br>";
  }

}

//削除ｐｈｐ
if(!empty($_POST["delete"])){

 //ファイル１行ずつ読み込み
 $array=file($filename);
 

 //ファイル内全削除、書き込み準備
 $fp=fopen($filename,"w");

 //分割し、削除対象でなければ書き込み
 foreach($array as $filename){
 $newdate=explode("<>",$filename);
 if($newdate[0]!==$delete){
    
    //ファイル
    fwrite($fp,$newdate."\n");
    fclose($fp);
    //ブラウザ
    echo$newdate[0]. " ";
    echo$newdate[1]. " ";
    echo$newdate[2]. " ";
    echo$newdate[3]. " ";
    echo"<br>";
 }
 }

}

}

?>
