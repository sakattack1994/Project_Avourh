<?php
if(isset($_POST['semesters7_10'])){
  $arr = array("professor_lessons_thisyear", "professor_lessons_lastyears");
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sem7_10=" ";
  $sql="SELECT LessonID FROM professor_lessons_thisyear WHERE StudyScheduleID=\"".$_POST['semesters7_10']."\"";
  $result1 = $conn->query($sql);
  if (!empty($result1)) {
    $sql="SELECT LessonID FROM professor_lessons_lastyears WHERE StudyScheduleID=\"".$_POST['semesters7_10']."\"";
    $result1 = $conn->query($sql);
  }
  $circles = array("Telecommunications & Information Technology", "Electric Power Systems","Electronics & Computers","Systems & Automatic Control");
  $sem7_10.="
  <div class=\"row\">
    <div class=\"col-md-8\">
      <form action=\"study_schedule_show.php\" method=\"POST\"><button type=\"submit\" class=\"add_new_button\" name=\"study_schedule_id\" value=".$_POST['semesters7_10'].">&rarr;Show semesters 1-6</button></form>
    </div>
  </div>";
for($j=0;$j<4;$j++){
  $sem7_10.="
  <div class=\"row\">
    <div class=\"col-md-8\">
      <h3>Circle of studies:<br>".$circles[$j]."</h3>
    </div>
  </div>";
  for($semester=7;$semester<11;$semester++){
      $sem7_10.="
      <div class=\"row\">
        <div class=\"col-md-8\">
          <h3>".$semester."st semester</h3>
        </div>
      </div>";
      $sem7_10.="
      <div class=\"row\">
        <div class=\"col-md-8\">
        <table class=\"table table-bordered table-hover\">
        <thead>
          <tr style=\"background-color:rgb(41,127,184);\";>
            <th style=\"text-align: center;\"><font color=\"#fff\">Lesson Code</font></th>
            <th style=\"text-align: center;\"><font color=\"#fff\">Lesson Title</font></th>
            <th style=\"text-align: center;\"><font color=\"#fff\">Δ</font></th>
            <th style=\"text-align: center;\"><font color=\"#fff\">Α</font></th>
            <th style=\"text-align: center;\"><font color=\"#fff\">Ε</font></th>
            <th style=\"text-align: center;\"><font color=\"#fff\">ECTS</font></th>
            <th style=\"text-align: center;\"><font color=\"#fff\">Professors</font></th>
          </tr>
        </thead><tbody>
        ";
      for($i=0;$i<2;$i++){
      $sql="SELECT * FROM lessons WHERE NOT Sector=\"Optional\" AND Sector=\"".$circles[$j]."\" AND Type=\"ΔΙΔΑΣΚΑΛΙΑ\"  AND Semester=".$semester." AND LessonID IN (SELECT LessonID FROM ".$arr[$i]." WHERE StudyScheduleID=\"".$_POST['semesters7_10']."\")";
      $result = $conn->query($sql);
      while($lesson = $result->fetch_assoc()){
        $profs="";
        $sql="SELECT * FROM ".$arr[$i]." WHERE StudyScheduleID=\"".$_POST['semesters7_10']."\" AND LessonID =\"".$lesson['LessonID']."\"";
        $result2 = $conn->query($sql);
        while($thisprofid = $result2->fetch_assoc()){
          $sql="SELECT FirstName,LastName FROM professors WHERE ProfessorID=\"".$thisprofid['ProfessorID']."\"";
          $result3 = $conn->query($sql);
          while($thisprof = $result3->fetch_assoc()){
            $profs.=$thisprof['LastName']." ".$thisprof['FirstName']." ";
          }
        }
        $sem7_10.="
        <tr>
          <td>".$lesson['LessonID']."</td>
          <td>".$lesson['Title']."</td>
          <td>".$lesson['EctsΔ']."</td>
          <td>".$lesson['EctsΑ']."</td>
          <td>".$lesson['EctsΕ']."</td>
          <td>".($lesson['EctsΔ']+$lesson['EctsΑ']+$lesson['EctsΕ'])."</td>
          <td>".$profs."</td>
        </tr>";
      }
      }
      $sem7_10.="</tbody></table></div></div>";
  }
}
  $conn->close();
  $content="<div class=\"col-md-9\"><div id=\"content\">
    <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-8\">
        <h1>Study schedule of Academic year ".$_POST['semesters7_10']."</h1>
      </div>
    </div>
    <div class=\"row\">
      <div class=\"col-md-8\">
      <h2>Study schedule for semesters 7-10</h2>
      </div>
    </div>
    ".$sem7_10."
      </div></div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
