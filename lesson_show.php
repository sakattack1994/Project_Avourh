<?php
if(isset($_POST['lesson_choose'])){
    $lesson="";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM lessons WHERE LessonID=\"".$_POST['lesson_choose']."\"";
    $result = $conn->query($sql);
    while($choice = $result->fetch_assoc()){
      $sql = "SELECT ProfessorID FROM professor_lessons_thisyear WHERE LessonID=\"".$_POST['lesson_choose']."\"";
      $result2 = $conn->query($sql);
      $professors="";
      while($choice2 = $result2->fetch_assoc()){
        $sql = "SELECT LastName,FirstName FROM professors WHERE ProfessorID=\"".$choice2['ProfessorID']."\"";
        $result3 = $conn->query($sql);
        while($choice3 = $result3->fetch_assoc()){
          $professors.=$choice3['LastName']." ".$choice3['FirstName']."<br>";
        }
      }
      $sql = "SELECT * FROM relative_courses WHERE LessonID=\"".$_POST['lesson_choose']."\"";
      $result2 = $conn->query($sql);
      $relativelessons="";
      while($choice2 = $result2->fetch_assoc()){
        $sql = "SELECT LessonID,Title FROM lessons WHERE LessonID=\"".$choice2['RelativeLessonID']."\"";
        $result3 = $conn->query($sql);
        while($choice3 = $result3->fetch_assoc()){
          $relativelessons.=$choice3['LessonID']." ".$choice3['Title']."<br>";
        }
      }
      $lab="";
      $sql = "SELECT * FROM lessons_labs WHERE LessonID=\"".$_POST['lesson_choose']."\"";
      $result2 = $conn->query($sql);
      while($choice2 = $result2->fetch_assoc()){
        $lab.=$choice2['LabID'];
      }
      $sql = "SELECT * FROM lesson_book WHERE LessonID=\"".$_POST['lesson_choose']."\"";
      $result2 = $conn->query($sql);
      $books="";
      while($choice2 = $result2->fetch_assoc()){
        $sql = "SELECT ISBN,Title,Cover FROM books WHERE ISBN=\"".$choice2['ISBN']."\"";
        $result3 = $conn->query($sql);
        while($choice3 = $result3->fetch_assoc()){
          $books.="ISBN: ".$choice3['ISBN'].", ".$choice3['Title']."<form action=\"book_show.php\" method=\"POST\"><button type=\"submit\" name=\"book_choose\" value=".$choice3['ISBN']."><font size=\"3px\"><img src=\"".$choice3['Cover']."\" width=\"140px\" height=\"150px\"></font></button></form><br>";
        }
      }
      $lesson.="
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-8\">
          <h1>".$choice['Title']."</h1>
        </div>
      </div>";


      $lesson.="<br><br>
      <div class=\"row\">
        <div class=\"col-md-8\">
          <h3>If you want to edit this lesson press here:</h3>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col-md-8\">
          <form action=\"edit_lesson.php\" method=\"POST\">
            <button type=\"submit\" name=\"lesson_id\" value=".$_POST['lesson_choose']." class=\"add_new_button\">EDIT LESSON</button>
          </form>
        </div>
      </div>";
      $lesson.="<br><br>
      <div class=\"row\">
        <div class=\"col-md-8\">
          <h3>If you want to delete this lesson press here:</h3>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col-md-8\">
          <form action=\"courses.php\" method=\"POST\">
            <button type=\"submit\" name=\"lesson_delete\" value=".$_POST['lesson_choose']." class=\"add_new_button\">DELETE LESSON</button>
          </form>
        </div>
      </div>
      <br><br>";



      $lesson.="
      <div class=\"row\">
        <div class=\"col-md-8\">
          <h3>General information:</h3>
        </div>
      </div>";
      $lesson.="
      <div class=\"row\">
        <div class=\"col-md-8\">
      <table class=\"table table-bordered table-hover\">
      <thead>
        <tr style=\"background-color:rgb(41,127,184);\";>
          <th colspan=8 style=\"text-align: center;\"><font color=\"#fff\">".$choice['Title']."</font></th>
          </tr>
          </thead>
      <tbody>
      <tr>
        <td>Lesson Code:</td><td>".$choice['LessonID']."</td>
      </tr>
      <tr>
        <td>Level of studies:</td><td>".$choice['LevelOfStudies']."</td>
      </tr>
      <tr>
        <td>Semester:</td><td>".$choice['Semester']."</td>
      </tr>
      <tr>
        <td>Description:</td><td>".$choice['Description']."</td>
      </tr>
      <tr>
        <td>Type:</td><td>".$choice['Type']."</td>
      </tr>
      <tr>
        <td>Official Website:</td><td>".$choice['OfficialWebsite']."</td>
      </tr>
      <tr>
        <td>Eclass Website:</td><td>".$choice['EclassLink']."</td>
      </tr>
      <tr>
        <td>Eudoxus Link:</td><td>".$choice['EudoxusLink']."</td>
      </tr>
      <tr>
        <td>Ects of Lecture:</td><td>".($choice['EctsΔ']+$choice['EctsΑ'])."</td>
      </tr>
      <tr>
        <td>Ects of Lab:</td><td>".$choice['EctsΕ']."</td>
      </tr>
      <tr>
        <td>Sector:</td><td>".$choice['Sector']."</td>
      </tr>
      <tr>
        <td>System of examination:</td><td>".$choice['SystemOfExamination']."</td>
      </tr>
      <tr>
        <td>Teaching hours and place:</td><td>".$choice['TeachingHoursAndPlace']."</td>
      </tr>
      <tr>
        <td>Recent statistics:</td><td>".$choice['StatisticsOfEvaluations']."</td>
      </tr>
      <tr>
        <td>Curriculum:</td><td>".$choice['Curriculum']."</td>
      </tr>
      <tr>
        <td>Lab ID:</td><td>".$lab."</td>
      </tr>
      <tr>
        <td>Books:</td><td>".$books."</td>
      </tr>
      <tr>
        <td>Professors:</td><td>".$professors."</td>
      </tr>
      <tr>
        <td>Relative Lessons:</td><td>".$relativelessons."</td>
      </tr>
      </tbody>
      </table></div></div></div>";
    }
    $conn->close();
    $content="<div class=\"col-md-9\"><div id=\"content\">".$lesson."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
