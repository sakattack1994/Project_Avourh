<?php
$alert="";
if(isset($_POST['lesson_delete'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $sql="DELETE FROM lessons_labs WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM lessons_book WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM lessons_comments WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM professor_lessons_thisyear WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM relative_courses WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM relative_courses WHERE RelativeLessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM students_lessons_enroll WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM lessons WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The lesson with id:".$_POST['lesson_delete']." was successfully deleted.</strong></div>";
}
if(isset($_POST['l_id'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql="DELETE FROM professor_lessons_thisyear WHERE LessonID=\"".$_POST['old_code']."\"";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $sql="DELETE FROM students_lessons_enroll WHERE LessonID=\"".$_POST['old_code']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM relative_courses WHERE LessonID=\"".$_POST['old_code']."\" ";
  $result = $conn->query($sql);
  $sql="UPDATE passed_lessons SET LessonID=\"".$_POST['l_id']."\" WHERE LessonID=\"".$_POST['old_code']."\"";
  $result = $conn->query($sql);
  $sql="UPDATE lesson_comments SET LessonID=\"".$_POST['l_id']."\" WHERE LessonID=\"".$_POST['old_code']."\"";
  $result = $conn->query($sql);
  $sql="UPDATE lesson_book SET LessonID=\"".$_POST['l_id']."\" WHERE LessonID=\"".$_POST['old_code']."\"";
  $result = $conn->query($sql);
  $sql="UPDATE lessons_labs SET LessonID=\"".$_POST['l_id']."\" WHERE LessonID=\"".$_POST['old_code']."\"";
  $result = $conn->query($sql);
  $sql="UPDATE lessons
  SET LessonID=\"".$_POST['l_id']."\",
  Title=\"".$_POST['l_title']."\",
  Description=\"".$_POST['l_description']."\",
  Type=\"".$_POST['l_type']."\",
  Semester=\"".$_POST['l_semester']."\",
  LevelOfStudies=\"".$_POST['l_level']."\",
  OfficialWebsite=\"".$_POST['l_officialwebsite']."\",
  EclassLink=\"".$_POST['l_eclasslink']."\",
  EudoxusLink=\"".$_POST['l_eudoxus']."\",
  EctsΔ=\"".$_POST['l_Δ']."\",
  EctsΑ=\"".$_POST['l_Α']."\",
  EctsΕ=\"".$_POST['l_Ε']."\",
  Sector=\"".$_POST['l_sector']."\",
  SystemOfExamination=\"".$_POST['l_exams']."\",
  TeachingHoursAndPlace=\"".$_POST['l_hours']."\",
  StatisticsOfEvaluations=\"".$_POST['l_statistics']."\",
  Curriculum=\"".$_POST['l_curriculum']."\"
  WHERE LessonID=\"".$_POST['old_code']."\"
  ";
  $result = $conn->query($sql);
  $i=1;
  while(true){
    if(isset($_POST['l_prof'.$i])){
      $sql="INSERT INTO professor_lessons_thisyear VALUES(\"".$_POST['l_prof'.$i]."\",\"".$_POST['l_id']."\",\"".$_POST['schedule']."\") ";
      $result = $conn->query($sql);
    }
    else{
      break;
    }
    $i=$i+1;
  }
  $i=1;
  while(true){
    if(isset($_POST['l_prof_new'.$i])){
      $sql="INSERT INTO professor_lessons_thisyear VALUES(\"".$_POST['l_prof_new'.$i]."\",\"".$_POST['l_id']."\",\"".$_POST['schedule']."\") ";
      $result = $conn->query($sql);
    }
    else{
      break;
    }
    $i=$i+1;
  }
  $i=1;
  while(true){
    if(isset($_POST['l_relative'.$i])){
      $sql="INSERT INTO relative_courses VALUES(\"".$_POST['l_id']."\",\"".$_POST['l_relative'.$i]."\") ";
      $result = $conn->query($sql);
    }
    else{
      break;
    }
    $i=$i+1;
  }
  $i=1;
  while(true){
    if(isset($_POST['l_relative_new'.$i])){
      $sql="INSERT INTO relative_courses VALUES(\"".$_POST['l_id']."\",\"".$_POST['l_relative_new'.$i]."\") ";
      $result = $conn->query($sql);
    }
    else{
      break;
    }
    $i=$i+1;
  }
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The lesson with id:".$_POST['l_id']." was successfully updated.</strong></div>";
}
//-----------------------------------------------------------------------------------------------------
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
  <br>".$alert."<br>
  ".$list."</form>


  <br>
      <h3>If you want to add a new lesson press here:</h3>
      <form action=\"add_new_lesson.php\" method=\"POST\">
        <button type=\"submit\" name=\"lesson_add\" class=\"add_new_button\">ADD NEW LESSON</button>
      </form>
  <br>







  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
