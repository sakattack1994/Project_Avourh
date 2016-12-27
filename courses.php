<?php
$conn = new mysqli('localhost', 'root', '', 'mydepartment');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql='SET NAMES utf8';
$result = $conn->query($sql);
$list=" ";
$semester=1;
for($i=1;$i<4;$i++){
  $list.="<h3>".$i."st year</h3>";
  for($j=1;$j<3;$j++){
    $list.="
      <table class=\"table table-bordered table-hover\">
      <thead>
        <tr style=\"background-color:rgb(41,127,184);\";>
          <th colspan=2 style=\"text-align: center;\"><font color=\"#fff\">Semester ".$semester."</font></th>
          </tr>
          <tr>
          <th colspan=1>Compulsory</th>
          <th colspan=1>Optional</th>
          </tr>
          </thead>
          <tbody><tr><td>";
    $sql="SELECT LessonID,Title FROM lessons WHERE NOT Sector=\"Optional\"  AND Semester=".$semester;
    $result = $conn->query($sql);
    while($lesson = $result->fetch_assoc()){
      $list.="<button type=\"submit\" name=\"lesson_choose\" value=".$lesson['LessonID']."><font size=\"2px\">".$lesson['LessonID']."&emsp;".$lesson['Title']."</font></button><br>";
    }
    $list.="</td><td>";
    $sql="SELECT LessonID,Title FROM lessons WHERE Sector=\"Optional\"  AND Semester=".$semester;
    $result = $conn->query($sql);
    while($lesson = $result->fetch_assoc()){
      $list.="<button type=\"submit\" name=\"lesson_choose\" value=".$lesson['LessonID']."><font size=\"2px\">".$lesson['LessonID']."&emsp;".$lesson['Title']."</font></button><br>";
    }
    $list.="</td></tr>";
    $list.="</tbody></table>";
    $semester=$semester+1;
  }
}
$semester=7;
$sectors = array("Telecommunications & Information Technology", "Electric Power Systems", "Electronics & Computers","Systems & Automatic Control");
for($i=4;$i<6;$i++){
  $list.="<h3>".$i."st year</h3>";
  for($j=0;$j<4;$j++){
    $list.="
      <table class=\"table table-bordered table-hover\">
      <thead>
        <tr style=\"background-color:rgb(41,127,184);\";>
          <th colspan=2 style=\"text-align: center;\"><font color=\"#fff\">".$sectors[$j]."</font></th>
          </tr>
          <tr>
          <th colspan=1>Semester ".$semester."</th>
          <th colspan=1>Semester ".($semester+1)."</th>
          </tr>
          </thead>
          <tbody><tr><td>";
    $sql="SELECT LessonID,Title FROM lessons WHERE Sector=\"".$sectors[$j]."\"  AND Semester=".$semester;
    $result = $conn->query($sql);
    while($lesson = $result->fetch_assoc()){
      $list.="<button type=\"submit\" name=\"lesson_choose\" value=".$lesson['LessonID']."><font size=\"2px\">".$lesson['LessonID']."&emsp;".$lesson['Title']."</font></button><br>";
    }
    $list.="</td><td>";
    $semester=$semester+1;
    $sql="SELECT LessonID,Title FROM lessons WHERE Sector=\"".$sectors[$j]."\" AND Semester=".$semester;
    $result = $conn->query($sql);
    while($lesson = $result->fetch_assoc()){
      $list.="<button type=\"submit\" name=\"lesson_choose\" value=".$lesson['LessonID']."><font size=\"2px\">".$lesson['LessonID']."&emsp;".$lesson['Title']."</font></button><br>";
    }
    $list.="</td></tr>";
    $list.="</tbody></table>";
    $semester=$semester-1;
  }
  $semester=9;
}
$conn->close();
$content="<div class=\"col-md-9\"><div id=\"content\">
  <form action=\"lesson_show.php\" method=\"POST\">
  <h1>Courses</h1>
  <br><br>
  ".$list."</form>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
