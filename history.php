<?php
  $myfile = fopen("myresources/history.txt", "r") or die("Unable to open file!");
  $content="<div class=\"col-md-9\"><div id=\"content\">".fread($myfile,filesize("myresources/history.txt"))."</div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
  fclose($myfile);
?>
