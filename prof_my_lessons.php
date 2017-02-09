<?php
if(!isset($_SESSION))
    {
      session_start();
    }
$conn = new mysqli('localhost', 'root', '', 'mydepartment');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql='SET NAMES utf8';
$result = $conn->query($sql);
$list=" ";
$list.="
  <table class=\"table table-bordered table-hover\">
  <thead>
    <tr style=\"background-color:rgb(41,127,184);\";>
      <th colspan=2 style=\"text-align: center;\"><font color=\"#fff\">My lessons this year</font></th>
      </tr>
  </thead>
  <tbody><tr><td>";
  $sql="SELECT LessonID FROM professor_lessons_thisyear WHERE ProfessorID=\"".$_SESSION['user']."\"";
  $result = $conn->query($sql);
  while($lessonid = $result->fetch_assoc()){
    $sql="SELECT Title,LessonID FROM lessons WHERE LessonID=\"".$lessonid['LessonID']."\"";
    $result2 = $conn->query($sql);
    while($lesson = $result2->fetch_assoc()){
        $list.="<button type=\"submit\" name=\"lesson_choose\" value=".$lesson['LessonID']."><font size=\"2px\">".$lesson['LessonID']."&emsp;".$lesson['Title']."</font></button><br>";
    }
  }
  $list.="</td><td></tbody></table>";
  $list2=" ";
  $list2.="
    <table class=\"table table-bordered table-hover\">
    <thead>
      <tr style=\"background-color:rgb(41,127,184);\";>
        <th colspan=2 style=\"text-align: center;\"><font color=\"#fff\">My lessons last years</font></th>
        </tr>
    </thead>
    <tbody><tr><td>";
    $sql="SELECT LessonID,StudyScheduleID FROM professor_lessons_lastyears WHERE ProfessorID=\"".$_SESSION['user']."\"";
    $result = $conn->query($sql);
    while($lessonid = $result->fetch_assoc()){
      $sql="SELECT Title,LessonID FROM lessons WHERE LessonID=\"".$lessonid['LessonID']."\"";
      $result2 = $conn->query($sql);
      while($lesson = $result2->fetch_assoc()){
          $list2.="<button type=\"submit\" name=\"lesson_choose\" value=".$lesson['LessonID']."><font size=\"2px\">".$lesson['LessonID']."&emsp;".$lesson['Title']."</font></button> at year ".$lessonid['StudyScheduleID']."<br>";
      }
    }
    $list2.="</td><td></tbody></table>";
$conn->close();
$content="<div class=\"col-md-9\"><div id=\"content\">
  <h1>My lessons</h1>
  <form action=\"lesson_show.php\" method=\"POST\">
  <br>
  ".$list.$list2."</form>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
