<?php
if(!isset($_SESSION))
    {
      session_start();
    }
$alert="";
if(isset($_POST['new_id'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $sql="INSERT INTO lessons VALUES
  (\"".$_POST['new_id']."\",
  \"".$_POST['new_title']."\",
  \"".$_POST['new_description']."\",
  \"".$_POST['new_type']."\",
  \"".$_POST['new_semester']."\",
  \"".$_POST['new_level']."\",
  \"".$_POST['new_officialwebsite']."\",
  \"".$_POST['new_eclasslink']."\",
  \"".$_POST['new_eudoxus']."\",
  \"".$_POST['new_Δ']."\",
  \"".$_POST['new_Α']."\",
  \"".$_POST['new_Ε']."\",
  \"".$_POST['new_sector']."\",
  \"".$_POST['new_exams']."\",
  \"".$_POST['new_curriculum']."\"
  )";
  $result = $conn->query($sql);
  $sql="INSERT INTO lessons_labs VALUES (\"".$_POST['new_id']."\",\"".$_POST['new_lab']."\")";
  $result = $conn->query($sql);
  $i=1;
  while(true){
    if(isset($_POST['l_prof_new'.$i])){
      $sql="INSERT INTO professor_lessons_thisyear VALUES(\"".$_POST['l_prof_new'.$i]."\",\"".$_POST['new_id']."\",\"".$_POST['schedule']."\") ";
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
      $sql="INSERT INTO relative_courses VALUES(\"".$_POST['new_id']."\",\"".$_POST['l_relative_new'.$i]."\") ";
      $result = $conn->query($sql);
    }
    else{
      break;
    }
    $i=$i+1;
  }
  $i=1;
  while(true){
    if(isset($_POST['l_day_new'.$i])){
      $sql="INSERT INTO lessons_hours VALUES(\"".$_POST['new_id']."\",\"".$_POST['l_day_new'.$i]."\",\"".$_POST['l_hours_new'.$i]."\",\"".$_POST['l_place_new'.$i]."\") ";
      $result = $conn->query($sql);
    }
    else{
      break;
    }
    $i=$i+1;
  }
  $i=1;
  while(true){
    if(isset($_POST['l_book_new'.$i])){
      $sql="INSERT INTO lesson_book VALUES(\"".$_POST['new_id']."\",\"".$_POST['l_book_new'.$i]."\") ";
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
  $alert="<div class=\"alert alert-success\"><strong>The lesson with id:".$_POST['new_id']." was successfully added.</strong></div>";
}
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
  $sql="DELETE FROM lessons_hours WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM lessons_book WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM lessons_comments WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM professor_lessons_thisyear WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM professor_lessons_lastyears WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM relative_courses WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM relative_courses WHERE RelativeLessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM students_lessons_enroll WHERE LessonID=\"".$_POST['lesson_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM passed_lessons WHERE LessonID=\"".$_POST['lesson_delete']."\"";
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
  $sql="DELETE FROM relative_courses WHERE LessonID=\"".$_POST['old_code']."\" ";
  $result = $conn->query($sql);
  $sql="DELETE FROM lesson_book WHERE LessonID=\"".$_POST['old_code']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM lessons_hours WHERE LessonID=\"".$_POST['old_code']."\"";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $sql="DELETE FROM lessons_labs WHERE LessonID=\"".$_POST['old_code']."\"";
  $result = $conn->query($sql);
  $sql="INSERT INTO lessons_labs VALUES (\"".$_POST['l_id']."\",\"".$_POST['l_lab']."\")";
  $result = $conn->query($sql);
  $sql="UPDATE lessons SET LessonID=\"".$_POST['l_lab']."\" WHERE LessonID=\"".$_POST['old_lab']."\" ";
  $result = $conn->query($sql);
  $sql="UPDATE relative_courses SET RelativeLessonID=\"".$_POST['l_id']."\" WHERE RelativeLessonID=\"".$_POST['old_code']."\" ";
  $result = $conn->query($sql);
  if($_POST['old_code']!=$_POST['l_id']){
    $sql="DELETE FROM students_lessons_enroll WHERE LessonID=\"".$_POST['old_code']."\"";
    $result = $conn->query($sql);
  }
  $sql="UPDATE professor_lessons_lastyears SET LessonID=\"".$_POST['l_id']."\" WHERE LessonID=\"".$_POST['old_code']."\"";
  $result = $conn->query($sql);
  $sql="UPDATE passed_lessons SET LessonID=\"".$_POST['l_id']."\" WHERE LessonID=\"".$_POST['old_code']."\"";
  $result = $conn->query($sql);
  $sql="UPDATE lesson_comments SET LessonID=\"".$_POST['l_id']."\" WHERE LessonID=\"".$_POST['old_code']."\"";
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
    if(isset($_POST['l_day'.$i])){
      $sql="INSERT INTO lessons_hours VALUES(\"".$_POST['l_id']."\",\"".$_POST['l_day'.$i]."\",\"".$_POST['l_hours'.$i]."\",\"".$_POST['l_place'.$i]."\") ";
      $result = $conn->query($sql);
    }
    else{
      break;
    }
    $i=$i+1;
  }
  $i=1;
  while(true){
    if(isset($_POST['l_day_new'.$i])){
      $sql="INSERT INTO lessons_hours VALUES(\"".$_POST['l_id']."\",\"".$_POST['l_day_new'.$i]."\",\"".$_POST['l_hours_new'.$i]."\",\"".$_POST['l_place_new'.$i]."\") ";
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
  $i=1;
  while(true){
    if(isset($_POST['l_book'.$i])){
      $sql="INSERT INTO lesson_book VALUES(\"".$_POST['l_id']."\",\"".$_POST['l_book'.$i]."\") ";
      $result = $conn->query($sql);
    }
    else{
      break;
    }
    $i=$i+1;
  }
  $i=1;
  while(true){
    if(isset($_POST['l_book_new'.$i])){
      $sql="INSERT INTO lesson_book VALUES(\"".$_POST['l_id']."\",\"".$_POST['l_book_new'.$i]."\") ";
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
if(isset($_SESSION['secretariat'])){
  $edit="<br>
      <h3>If you want to add a new lesson press here:</h3>
      <form action=\"add_new_lesson.php\" method=\"POST\">
        <button type=\"submit\" name=\"lesson_add\" class=\"add_new_button\">ADD NEW LESSON</button>
      </form>
  <br>";
}
else{
  $edit="";
}
$content="<div class=\"col-md-9\"><div id=\"content\">
  <h1>Courses</h1>
  ".$edit."
  <form action=\"lesson_show.php\" method=\"POST\">
  ".$alert."<br>
  ".$list."</form>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
