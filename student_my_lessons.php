<?php
if(!isset($_SESSION))
    {
      session_start();
    }
$alert="";
if(isset($_POST['lesson_unenroll'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
    // Check connection
  if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql="DELETE FROM students_lessons_enroll WHERE StudentID=\"".$_SESSION['user']."\" AND LessonID=\"".$_POST['lesson_unenroll']."\" ";
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>You have successfully unenrolled.</strong></div>";
}

$conn = new mysqli('localhost', 'root', '', 'mydepartment');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql='SET NAMES utf8';
$result = $conn->query($sql);
$list="
  <table class=\"table table-bordered table-hover\">
  <thead>
    <tr style=\"background-color:rgb(41,127,184);\";>
      <th colspan=4 style=\"text-align: center;\"><font color=\"#fff\">My Lessons</font></th>
      </tr>
  </thead>
  <tbody>";
  $sql="SELECT LessonID FROM students_lessons_enroll WHERE StudentID=\"".$_SESSION['user']."\"";
  $result = $conn->query($sql);
  while($les_id = $result->fetch_assoc()){
    $sql="SELECT LessonID,Title,Type,Semester FROM lessons WHERE LessonID=\"".$les_id['LessonID']."\"";
    $result2 = $conn->query($sql);
    $list.="<tr>";
    while($les = $result2->fetch_assoc()){
        $list.="<td colspan=3>
        <form action=\"lesson_show.php\" method=\"POST\">
          <button type=\"submit\" name=\"lesson_choose\" value=".$les['LessonID']."><font size=\"2px\"><b>ID:</b> ".$les['LessonID']." &nbsp <b>Title:</b> ".$les['Title']."  &nbsp<b>Type:</b> ".$les['Type']."  &nbsp<b>Semester:</b> ".$les['Semester']."</font></button>
        </form></td>
        <td colspan=1>
        <form action=\"student_my_lessons.php\" method=\"POST\">
          <button type=\"submit\" name=\"lesson_unenroll\" value=\"".$les['LessonID']."\">UNENROLL</button>
        </form>
        </td>";
    }
    $list.="</td></tr>";
  }
  $list.="</tbody></table>";
  $conn->close();
  $content="<div class=\"col-md-9\"><div id=\"content\">
  <h1>Portfolio User</h1>
  ".$alert."
  <br>
  ".$list."
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
