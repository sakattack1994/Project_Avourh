<?php
$alert="";
if(isset($_POST['delete_study_schedule'])){
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "DELETE FROM professor_lessons_thisyear WHERE StudyScheduleId=\"".$_POST['delete_study_schedule']."\"";
    $result = $conn->query($sql);
    $sql = "DELETE FROM professor_lessons_lastyears WHERE StudyScheduleId=\"".$_POST['delete_study_schedule']."\"";
    $result = $conn->query($sql);
    $sql = "DELETE FROM study_schedule WHERE id=\"".$_POST['delete_study_schedule']."\"";
    $result = $conn->query($sql);
    $conn->close();
    $alert="<div class=\"alert alert-success\"><strong>Study schedule was successfully deleted.</strong></div>";
}
if(isset($_POST['starting_year'])){
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM professor_lessons_thisyear";
    $result = $conn->query($sql);
    while($temp = $result->fetch_assoc()){
      $sql = "INSERT INTO professor_lessons_lastyears VALUES(\"".$temp['ProfessorID']."\",\"".$temp['LessonID']."\",\"".$temp['StudyScheduleID']."\")";
      $result2 = $conn->query($sql);
    }
    $sql = "DELETE FROM professor_lessons_thisyear";
    $result = $conn->query($sql);
    $sql = "INSERT INTO study_schedule VALUES(\"".$_POST['starting_year']."-".$_POST['ending_year']."\",\"Study guide ".$_POST['starting_year']."-".$_POST['ending_year']."\")";
    $result = $conn->query($sql);
    for($i=1;$i<11;$i++){
      if (!empty($_POST[$i.'s'])) {
        foreach ($_POST[$i.'s'] as $selectedlesson) {
          if (!empty($_POST[$i.'s'.$selectedlesson])) {
            foreach ($_POST[$i.'s'.$selectedlesson] as $selectedprof) {
              $sql = "INSERT INTO professor_lessons_thisyear VALUES(\"".$selectedprof."\",\"".$selectedlesson."\",\"".$_POST['starting_year']."-".$_POST['ending_year']."\")";
              $result = $conn->query($sql);
            }
          }
        }
      }
    }
    $conn->close();
    $alert="<div class=\"alert alert-success\"><strong>Study schedule was successfully added.</strong></div>";
}
//------------------------------------------------------------------------------------------------------------------
$conn = new mysqli('localhost', 'root', '', 'mydepartment');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql='SET NAMES utf8';
$result = $conn->query($sql);
$sql = "SELECT id,name FROM study_schedule ORDER BY id ASC";
$result = $conn->query($sql);
$list="";
while($study_guide = $result->fetch_assoc()){
  $list.="
  <tr>
    <td id=".$study_guide['id']."><strong>".$study_guide['name']."</strong></td>
    <td><form action=\"study_schedule.php\" method=\"POST\"><button type=\"submit\" name=\"delete_study_schedule\" value=".$study_guide['id']."><img src=\"images/x.png\" width=25px></button></form></td>
  </tr>";
}
$conn->close();
$delete="<th>Delete</th>";
$content="<div class=\"col-md-9\"><div id=\"content\">
  <h1>Study guides</h1>".$alert."



  <h3>If you want to add new study guide press here:</h3>
  <a href=\"add_study_schedule.php\"><button type=button class=\"add_new_button\">&#9546;Add New</button></a>
  <br> <br>


  <table class=\"table table-bordered table-hover\">
  <thead>
    <tr>
      <th>Study guide</th>
      ".$delete."
    </tr>
  </thead>
  <tbody>".$list."</tbody>
</table>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
