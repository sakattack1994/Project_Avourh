<?php
if(isset($_POST['lesson_choose'])){
    $lesson="";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM lessons WHERE LessonID=\"".$_POST['lesson_choose']."\"";
    $result = $conn->query($sql);
    while($choice = $result->fetch_assoc()){
      $lesson.="<h1>".$choice['Title']."</h1>";
    }
    $conn->close();
    $content="<div class=\"col-md-9\"><div id=\"content\">".$lesson."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\">".$choice."</div></div>";
    include 'WebPageTemplate.php';
}
?>
