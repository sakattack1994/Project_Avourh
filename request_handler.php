<?php
if(isset($_POST['announcement_title'])){
  $announcement_title=$_POST['announcement_title'];
  $dir = $_SERVER['DOCUMENT_ROOT'] .'/dokimes/myresources/announcements/';
  $file=fopen($dir.$announcement_title, "r") or die("Unable to open file!");
  $result=fread($file,filesize($dir.$announcement_title));
  fclose($file);
  echo $result;
}
?>
