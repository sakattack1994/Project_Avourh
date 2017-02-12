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
      <th style=\"text-align: center;\"><font color=\"#fff\">Lesson</font></th>
      <th style=\"text-align: center;\"><font color=\"#fff\">Students Enrolled</font></th>
      <th style=\"text-align: center;\"><font color=\"#fff\">Evaluation(%)</font></th>
    </tr>
  </thead>
  <tbody>";
  $sql="SELECT LessonID FROM professor_lessons_thisyear WHERE ProfessorID=\"".$_SESSION['user']."\"";
  $result = $conn->query($sql);
  while($lessonid = $result->fetch_assoc()){
    $sql="SELECT Title,LessonID FROM lessons WHERE LessonID=\"".$lessonid['LessonID']."\"";
    $result2 = $conn->query($sql);
    $list.="<tr>";
    while($lesson = $result2->fetch_assoc()){
        $list.="
        <td><form action=\"lesson_show.php\" method=\"POST\">
          <button type=\"submit\" name=\"lesson_choose\" value=".$lesson['LessonID']."><font size=\"2px\">".$lesson['LessonID']."&emsp;".$lesson['Title']."</font></button>
        </form></td>
        ";
    }
    $sql="SELECT StudentID FROM students_lessons_enroll WHERE LessonID=\"".$lessonid['LessonID']."\" ";
    $result3 = $conn->query($sql);
    $sum=0;
    while($stud = $result3->fetch_assoc()){
        $sum=$sum+1;
    }
    $list.="<td style=\"text-align:center;\">".$sum."</td>";
    if($sum==0){
      $list.="<td style=\"text-align:center;\">0</td>";
    }
    else{
      $sql="SELECT Evaluation FROM lesson_evaluations WHERE LessonID=\"".$lessonid['LessonID']."\" ";
      $result4 = $conn->query($sql);
      $sum1=0;
      $i=0;
      while($eval = $result4->fetch_assoc()){
          $sum1=$sum1+$eval['Evaluation'];
          $i=$i+1;
      }
      $list.="<td style=\"text-align:center;\">".$sum1/$i."</td>";
    }
    $list.="</tr>";
  }
  $list.="</tbody></table>";

$conn->close();
$content="<div class=\"col-md-9\"><div id=\"content\">
  <h1>Statistics</h1>
  ".$list."
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
