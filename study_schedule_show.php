<?php
if(isset($_POST['study_schedule_id'])){
  $arr = array("professor_lessons_thisyear", "professor_lessons_lastyears");
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sem1_6=" ";
  $sql="SELECT LessonID FROM professor_lessons_thisyear WHERE StudyScheduleID=\"".$_POST['study_schedule_id']."\"";
  $result1 = $conn->query($sql);
  if (!empty($result1)) {
    $sql="SELECT LessonID FROM professor_lessons_lastyears WHERE StudyScheduleID=\"".$_POST['study_schedule_id']."\"";
    $result1 = $conn->query($sql);
  }
  $sem1_6.="
  <div class=\"row\">
    <div class=\"col-md-8\">
      <form action=\"study_schedule_show_7_10.php\" method=\"POST\"><button type=\"submit\" class=\"add_new_button\" name=\"semesters7_10\" value=".$_POST['study_schedule_id'].">&rarr;Show semesters 7-10</button></form>
    </div>
  </div>";
  for($semester=1;$semester<7;$semester++){
      $d=0;
      $a=0;
      $e=0;
      $sem1_6.="
      <div class=\"row\">
        <div class=\"col-md-8\">
          <h3>".$semester."st semester</h3>
        </div>
      </div>";
      $sem1_6.="
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
      $sql="SELECT * FROM lessons WHERE NOT Sector=\"Optional\"  AND Type=\"ΔΙΔΑΣΚΑΛΙΑ\"  AND Semester=".$semester." AND LessonID IN (SELECT LessonID FROM ".$arr[$i]." WHERE StudyScheduleID=\"".$_POST['study_schedule_id']."\")";
      $result = $conn->query($sql);
      while($lesson = $result->fetch_assoc()){
        $profs="";
        $sql="SELECT * FROM ".$arr[$i]." WHERE StudyScheduleID=\"".$_POST['study_schedule_id']."\" AND LessonID =\"".$lesson['LessonID']."\"";
        $result2 = $conn->query($sql);
        while($thisprofid = $result2->fetch_assoc()){
          $sql="SELECT FirstName,LastName FROM professors WHERE ProfessorID=\"".$thisprofid['ProfessorID']."\"";
          $result3 = $conn->query($sql);
          while($thisprof = $result3->fetch_assoc()){
            $profs.=$thisprof['LastName']." ".$thisprof['FirstName']." ";
          }
        }
        $sem1_6.="
        <tr>
          <td>".$lesson['LessonID']."</td>
          <td>".$lesson['Title']."</td>
          <td>".$lesson['EctsΔ']."</td>
          <td>".$lesson['EctsΑ']."</td>
          <td>".$lesson['EctsΕ']."</td>
          <td>".($lesson['EctsΔ']+$lesson['EctsΑ']+$lesson['EctsΕ'])."</td>
          <td>".$profs."</td>
        </tr>";
        $d=$d+$lesson['EctsΔ'];
        $a=$a+$lesson['EctsΑ'];
        $e=$e+$lesson['EctsΕ'];
      }
      }
      if($semester<=2){
        $sem1_6.="<tr><td colspan=7 style=\"text-align: center;\"><strong>Choose one of these optional lessons:<strong></td></tr>";
        for($i=0;$i<2;$i++){
        $sql="SELECT * FROM lessons WHERE Sector=\"Optional\"  AND Type=\"ΔΙΔΑΣΚΑΛΙΑ\"  AND Semester=".$semester." AND LessonID IN (SELECT LessonID FROM ".$arr[$i]." WHERE StudyScheduleID=\"".$_POST['study_schedule_id']."\")";
        $result = $conn->query($sql);
        while($lesson = $result->fetch_assoc()){
          $profs="";
          $sql="SELECT * FROM ".$arr[$i]." WHERE StudyScheduleID=\"".$_POST['study_schedule_id']."\" AND LessonID =\"".$lesson['LessonID']."\"";
          $result2 = $conn->query($sql);
          while($thisprofid = $result2->fetch_assoc()){
            $sql="SELECT FirstName,LastName FROM professors WHERE ProfessorID=\"".$thisprofid['ProfessorID']."\"";
            $result3 = $conn->query($sql);
            while($thisprof = $result3->fetch_assoc()){
              $profs.=$thisprof['LastName']." ".$thisprof['FirstName']." ";
            }
          }
          $sem1_6.="
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
        $d=$d+2;
        $a=$a+1;
     }
     $sem1_6.="
     <tr>
       <td></td>
       <td><strong>Total ECTS of ".$semester." semester</strong></td>
       <td>".$d."</td>
       <td>".$a."</td>
       <td>".$e."</td>
       <td>".($d+$a+$e)."</td>
       <td></td>
     </tr>";
      $sem1_6.="</tbody></table></div></div>";
  }
  $conn->close();
  $content="<div class=\"col-md-9\"><div id=\"content\">
    <div class=\"container\">
    <div class=\"row\">
      <div class=\"col-md-8\">
        <h1>Study schedule of Academic year ".$_POST['study_schedule_id']."</h1>
      </div>
    </div>
    <div class=\"row\">
      <div class=\"col-md-8\">
      <h2>Study schedule for semesters 1-6</h2>
      </div>
    </div>
    ".$sem1_6."
      </div></div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
