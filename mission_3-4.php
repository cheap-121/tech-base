<?php
//ファイルに書き込み
$filename="mission_3-4.txt";

//新規投稿の場合(条件分岐）
if(!empty($_POST["comment"])&&empty($_POST["editno"])){

 //フォームのデータ受け取り
 if(file_exists($filename)){
 //ファイル内最後の投稿の番号を取得
  $lines=file($filename);
  $lastline=end($lines);
  $value=explode("<>",$lastline);
 $postnumber=$value[0]+1;
 
 }else{
 $postnumber=1;
 }
 $name=$_POST["name"];
 $comment=$_POST["comment"];
 $time=date("Y年m月d日　H:i:s");
 
 //新規投稿１行で
 $newdate=$postnumber."<>".$name."<>".$comment."<>".$time;
 
 //書き込み
 $fp=fopen($filename,"a");
 fwrite($fp,$newdate."\n");
 fclose($fp);

}

//削除の場合(条件分岐)
if(!empty($_POST["delete"])){

 //フォームのデータ受け取り
 $delete=$_POST["delete"];

 //ファイル1行ずつ読み込み
 $lines=file($filename);

 //ファイル内全削除、書き込み準備
 $fp=fopen($filename,"w");

 //分割し、削除対象でなければ書き込み(1行ずつループ)
 foreach($lines as $line){
 $post=explode("<>",$line);
 if($post[0]!==$delete){
  
  $fp2=fopen($filename,"a");
  fwrite($fp2,$line);
  fclose($fp2);
 
 }
 }
 fclose($fp);
}

//編集の選択(条件分岐)
if(!empty($_POST["edit"])){
 
 //フォームのデータ受け取り
 $edit=$_POST["edit"];

 //ファイル1行ずつ読み込み
 $lines=file($filename);

 //ファイル開く
 $fp=fopen($filename,"r");

 //分割して、編集対象なら番号名前コメントを取得(1行ずつループ)
 foreach($lines as $line){
 $post=explode("<>",$line);
 if($post[0]==$edit){
 $editno=$post[0];
 $editname=$post[1];
 $editcomment=$post[2];
 }
 }

 fclose($fp);

}

//編集投稿の場合(条件分岐)
if(!empty($_POST["editno"])){

 //フォームのデータ受け取り
 $editno=$_POST["editno"];
 $name=$_POST["name"];
 $comment=$_POST["comment"];
 $time=date("Y年m月d日　H:i:s");

 //編集済みデータ1行で
 $editdate=$editno."<>".$name."<>".$comment."<>".$time;
 
 //ファイル1行ずつ読み取り
 $lines=file($filename);
 
 //ファイル内全削除、書き込み準備
 $fp=fopen($filename,"w");

 //分割し、これまでの投稿と編集と分岐(1行ずつループ)
 foreach($lines as $line){
 $post=explode("<>",$line);
   
    //編集対象でなければそのまま書き込み
    if($post[0]!==$editno){
    $fp2=fopen($filename,"a");
    fwrite($fp2,$line);
    fclose($fp2);
    }

    //編集対象なら編集済みデータを書き込み
    if($post[0]==$editno){
    $fp3=fopen($filename,"a");
    fwrite($fp3,$editdate."\n");
    fclose($fp3);
    }

 }
fclose($fp);
}

?>

<meta charset="uft-8">
<form action="mission_3-4.php" method="post">
<p>
<input type="text" name="name" placeholder="名前" value="<?php if(!empty($edit)){echo$editname;}?>">
</p>
<p>
<input type="text" name="comment" placeholder="コメント" value="<?php if(!empty($edit)){echo$editcomment;}?>">

<input type="hidden" name="editno" value="<?php if(!empty($edit)){echo$editno;}?>">
<input type="submit" value="送信">
<p/>
</form>
<form action="mission_3-4.php" method="post">
<p>
<input type="number" name="delete" placeholder="削除対象番号">
<input type="submit" value="削除">
</p>
</form>
<form action="mission_3-4.php" method="post">
<p>
<input type="number" name="edit" placeholder="編集対象番号">
<input type="submit" value="編集">
</p>
</form>


<?php
//ブラウザに出力
$filename="mission_3-4.txt";
if(file_exists($filename)){
$fp=fopen($filename,"r");
$lines=file($filename);
 foreach($lines as $line){
 $output=explode("<>",$line);
 echo$output[0]." ";
 echo$output[1]." ";
 echo$output[2]." ";
 echo$output[3]." ";
 echo"<br>";
 }
}
?>
