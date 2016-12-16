<?php
if(isset($_POST['announcement_id'])){
  $announcement_id=$_POST['announcement_id'];
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql = "SELECT Header, Content FROM announcements WHERE ID=\"".$announcement_id."\"";
  $result = $conn->query($sql);
  $announcement = $result->fetch_assoc();
  $html="<h1>".$announcement['Header']."</h1><p>".$announcement['Content']."</p>";
  $sql = "SELECT dir FROM attachments WHERE ID=\"".$announcement_id."\"";
  $result = $conn->query($sql);
  $html.="<h2>Attachments:</h2>";
  while($att = $result->fetch_assoc()){
    $html.="<a href=\"".$att['dir']."\" download>".basename($att['dir'])."</a><br>";
  }
  $conn->close();
  echo $html;
}
?>
