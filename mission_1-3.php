<?php
$filename="mission_1-2.txt";
$fp=fopen($filename,"r");
$txt=fgets($fp);
echo$txt;
fclose($fp);
?>
