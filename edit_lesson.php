<?php
if(isset($_POST['lesson_id'])){
    $lesson="";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM lessons WHERE LessonID=\"".$_POST['lesson_id']."\"";
    $result = $conn->query($sql);
    while($choice = $result->fetch_assoc()){
      if($choice['Title']==-1){
        $level="Undergraduate";
      }
      else{
        $level="Postgraduate";
      }
      $sql = "SELECT ProfessorID FROM professor_lessons_thisyear WHERE LessonID=\"".$_POST['lesson_id']."\"";
      $result2 = $conn->query($sql);
      $professors="";
      while($choice2 = $result2->fetch_assoc()){
        $sql = "SELECT LastName,FirstName FROM professors WHERE ProfessorID=\"".$choice2['ProfessorID']."\"";
        $result3 = $conn->query($sql);
        while($choice3 = $result3->fetch_assoc()){
          $professors.=$choice3['LastName']." ".$choice3['FirstName']."<br>";
        }
      }
      $lesson.="<div class=\"container\"><form action=\"courses.php\" method=\"POST\"><div class=\"form-group\">";
      $lesson.="
      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h1>".$choice['Title']."</h1></label>
        </div>
      </div>";
      $lesson.="
      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h1><h3>General information:</h3></h1></label>
        </div>
      </div>";
      $lesson.="
      <div class=\"row\"><div class=\"col-md-8\">
      <table class=\"table table-bordered table-hover\" id=\"update_table\">
      <tr>
        <td style=\"visibility:hidden;display:none;\"><input type=\"text\" name=\"old_code\" value=\"".$choice['LessonID']."\"></td>
      </tr>
      <tr>
        <td>Title:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_title\" value=\"".$choice['Title']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Lesson Code:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_id\" value=\"".$choice['LessonID']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Level of studies:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_level\" value=\"".$choice['LevelOfStudies']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Semester:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_semester\" value=\"".$choice['Semester']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Description:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_description\" value=\"".$choice['Description']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Type:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_type\" value=\"".$choice['Type']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Official Website:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_officialwebsite\" value=\"".$choice['OfficialWebsite']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Eclass Website:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_eclasslink\" value=\"".$choice['EclassLink']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Eudoxus Link:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_eudoxus\" value=\"".$choice['EudoxusLink']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Ects of Lecture:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_Δ\" value=\"".$choice['EctsΔ']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Ects of A:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_Α\" value=\"".$choice['EctsΑ']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Ects of Lab:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_Ε\" value=\"".$choice['EctsΕ']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Sector:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_sector\" value=\"".$choice['Sector']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>System of examination:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_exams\" value=\"".$choice['SystemOfExamination']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Teaching hours and place:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_hours\" value=\"".$choice['TeachingHoursAndPlace']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Recent statistics:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_statistics\" value=\"".$choice['StatisticsOfEvaluations']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Curriculum:</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_curriculum\" value=\"".$choice['Curriculum']."\" style=\"height:100%; width:100%;\"></td>
      </tr>";
      $sql = "SELECT * FROM professor_lessons_thisyear WHERE LessonID=\"".$_POST['lesson_id']."\"";
      $result2 = $conn->query($sql);
      $i=1;
      while($choice2 = $result2->fetch_assoc()){
        if($i==1){
          $lesson.="<tr>
            <td style=\"visibility:hidden;display:none;\"><input type=\"text\" name=\"schedule\" value=\"".$choice2['StudyScheduleID']."\"></td>
          </tr>";
        }
        $sql = "SELECT LastName,FirstName FROM professors WHERE ProfessorID=\"".$choice2['ProfessorID']."\"";
        $result3 = $conn->query($sql);
        while($choice3 = $result3->fetch_assoc()){
          $lesson.="
          <tr>
            <td>Professor ".$i.":</td><td style=\"padding:0;\"><input type=\"text\" name=\"l_prof".$i."\" value=\"".$choice2['ProfessorID']."\" style=\"height:100%; width:100%;\"></td>
          </tr>";
          $i=$i+1;
        }
      }
      $lesson.="</table></div></div>";
    }
    $lesson.="<br><br>
    <div class=\"row\"><div class=\"col-md-8\">
    <button type=\"button\" class=\"add_new_button\" onclick=\"new_prof();\">&#9546;ADD NEW PROFESSOR</button>
    <h3>If you finished editing press here:</h3>
    <input type=\"submit\" value=\"FINISH\" class=\"add_new_button\">
    </div></div>
    </div></form></div>
    <br><br>";
    $conn->close();
    $content="<div class=\"col-md-9\"><div id=\"content\">".$lesson."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\">".$choice."</div></div>";
    include 'WebPageTemplate.php';
}
?>
