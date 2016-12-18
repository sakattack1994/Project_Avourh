<?php
$alert="";
if(isset($_POST['delete_study_schedule'])){
  echo $_POST['delete_study_schedule'];
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "DELETE FROM study_schedule_lessons WHERE StudyScheduleID=\"".$_POST['delete_study_schedule']."\"";
    $result = $conn->query($sql);
    if($_POST['delete_study_schedule']=='1'){
      $sql = "DELETE FROM professor_lessons_thisyear";
    }else{
      $sql = "DELETE FROM professor_lessons_lastyear";
    }
    $result = $conn->query($sql);
    $sql = "DELETE FROM study_schedule WHERE id=\"".$_POST['delete_study_schedule']."\"";
    $result = $conn->query($sql);
    $conn->close();
    $alert="<div class=\"alert alert-success\"><strong>Study schedule was successfully deleted.</strong></div>";
}
//------------------------------------------------------------------------------------------------------------------
$conn = new mysqli('localhost', 'root', '', 'mydepartment');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql='SET NAMES utf8';
$result = $conn->query($sql);
$sql = "SELECT id,name FROM study_schedule ORDER BY name DESC";
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
  <a href=\"add_announcement.php\"><button type=button class=\"add_new_button\">&#9546;Add New</button></a>
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
