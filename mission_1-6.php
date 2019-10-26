<?php
for($i=2000;$i<=2019;$i=$i+4){
echo$i."<br>";
}
echo"<br>"."<br>";
$shiritori=array("しりとり","りんご","ごりら","らっぱ","ぱんだ",);
echo$shiritori[2];
echo"<br>"."<br>";

$str = '';
foreach ($shiritori as $word){
$str .= $word;
echo $str . "<br>";
}
?>