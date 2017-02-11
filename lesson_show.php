<?php
if(!isset($_SESSION))
    {
      session_start();
    }
    $alert="";
    if(isset($_POST['delete_comment'])){
      $conn = new mysqli('localhost', 'root', '', 'mydepartment');
        // Check connection
      if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
      $sql='SET NAMES utf8';
      $result = $conn->query($sql);
      $sql="DELETE FROM lesson_comments WHERE CommentID=\"".$_POST['delete_comment']."\"";
      $result = $conn->query($sql);
      $sql="DELETE FROM comments WHERE CommentID=\"".$_POST['delete_comment']."\"";
      $result = $conn->query($sql);
      $conn->close();
      $alert="<div class=\"alert alert-success\"><strong>Your comment was successfully deleted.</strong></div>";
    }

if(isset($_POST['content'])){
      $conn = new mysqli('localhost', 'root', '', 'mydepartment');
        // Check connection
      if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
      $sql='SET NAMES utf8';
      $result = $conn->query($sql);
      $id="com_".strftime("%m/%d/%y",time()).time();
      $sql="INSERT INTO comments VALUES(\"".$id."\",\"".$_POST['content']."\",\"".$_POST['anon']."\",CURRENT_TIMESTAMP)";
      $result = $conn->query($sql);
      $sql="INSERT INTO lesson_comments VALUES(\"".$_POST['lesson_choose']."\",\"".$id."\",\"".$_SESSION['user']."\",CURRENT_TIMESTAMP)";
      $result = $conn->query($sql);
      $conn->close();
      $alert="<div class=\"alert alert-success\"><strong>You have successfully made a comment on this lesson.</strong></div>";
}

if(isset($_POST['lesson_enroll'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
    // Check connection
  if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql="INSERT INTO students_lessons_enroll VALUES(\"".$_SESSION['user']."\",\"".$_POST['lesson_enroll']."\")";
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>You have successfully enrolled.</strong></div>";
}
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
      if(isset($_SESSION['student'])){
        if($_SESSION['student']==1){
          $sql = "SELECT * FROM students_lessons_enroll WHERE StudentID=\"".$_SESSION['user']."\"";
          $result5 = $conn->query($sql);
          $f=0;
          while($choice5 = $result5->fetch_assoc()){
            if($choice5['LessonID']==$_POST['lesson_choose']){
              $f=1;
            }
          }
          if($f==0){
            $lesson.="
            <div class=\"row\">
              <div class=\"col-md-8\">".$alert
            ."</div>
          </div>
            <br><br>
            <div class=\"row\">
              <div class=\"col-md-8\">
                <h3>If you want to enroll to this lesson press here:</h3>
              </div>
            </div>
            <div class=\"row\">
              <div class=\"col-md-8\">
                <form action=\"lesson_show.php\" method=\"POST\">
                  <input type=\"text\" name=\"lesson_enroll\" value=\"".$_POST['lesson_choose']."\" style=\"visibility:hidden;display:none;\">
                  <button type=\"submit\" name=\"lesson_choose\" value=".$_POST['lesson_choose']." class=\"add_new_button\">ENROLL</button>
                </form>
             </div>
            </div>";
          }
          else if($f==1){
            $lesson.="<br><br>
            <div class=\"row\">
              <div class=\"col-md-8\">
                <h3>If you want to unenroll from this lesson press here:</h3>
              </div>
            </div>
            <div class=\"row\">
              <div class=\"col-md-8\">
                <form action=\"lesson_show.php\" method=\"POST\">
                  <input type=\"text\" name=\"lesson_unenroll\" value=\"".$_POST['lesson_choose']."\" style=\"visibility:hidden;display:none;\">
                  <button type=\"submit\" name=\"lesson_choose\" value=".$_POST['lesson_choose']." class=\"add_new_button\">UNENROLL</button>
                </form>
             </div>
            </div>";
          }
        }
      }
      if(isset($_SESSION['user'])){
        $sql = "SELECT ProfessorID FROM professor_lessons_thisyear WHERE LessonID=\"".$_POST['lesson_choose']."\"";
        $result2 = $conn->query($sql);
        while($choice2 = $result2->fetch_assoc()){
          if($_SESSION['user']==$choice2['ProfessorID']){
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
          }
        }
      }
      if(isset($_SESSION['secretariat'])){
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
        </div>
        <br><br>
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
      }
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
      </table></div></div>";
    }
  if(isset($_SESSION['user'])){
    $sql = "SELECT FirstName,LastName,ID FROM members WHERE ID=\"".$_SESSION['user']."\"";
    $result8 = $conn->query($sql);
    $my_name="";
    while($choice8 = $result8->fetch_assoc()){
      $my_name.=$choice8['LastName']." ".$choice8['FirstName'];
    }
    if(isset($_SESSION['student'])){
      $lesson.="
      <div class=\"row\">
        <div class=\"col-md-8\">
            <h3>Comment this lesson:</h3>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col-md-8\">
          <form action=\"lesson_show.php\" method=\"post\">
            <label>Select to post the comment as:</label>
            <select name=\"anon\" required=\"\">
              <option value=\"0\">".$my_name."</option>
              <option value=\"1\">Anonymous</option>
            </select>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col-md-8\">
            <textarea rows=\"3\" cols=\"100\" placeholder=\"Leave your comment here.....\" name=\"content\"></textarea>
            <input style=\"visibility:hidden;display:none;\" type=\"text\" name=\"lesson_choose\" value=\"".$_POST['lesson_choose']."\"></td>
        </div>
      </div>
      <div class=\"row\">
        <div class=\"col-md-8\">
          <input type=\"submit\" value=\"POST COMMENT\" class=\"add_new_button\">
          </form>
        </div>
      </div>
      ";
    }
  }
    $lesson.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <h2>Comments</h2>
      </div>
    </div>
    ";
    $sql = "SELECT * FROM lesson_comments WHERE LessonID=\"".$_POST['lesson_choose']."\" ORDER BY date DESC";
    $result = $conn->query($sql);
    while($choice = $result->fetch_assoc()){
      $total_comment="";
      $sql = "SELECT FirstName,LastName,Photo FROM students WHERE StudentID=\"".$choice['StudentID']."\"";
      $result2 = $conn->query($sql);
      while($choice2 = $result2->fetch_assoc()){
        $sql = "SELECT Anonymity FROM comments WHERE CommentID=\"".$choice['CommentID']."\"";
        $result5 = $conn->query($sql);
        $delete_comment="";
        if(isset($_SESSION['user']))
        {
          if($_SESSION['user']==$choice['StudentID']){
            $delete_comment.="
            <form action=\"lesson_show.php\" method=\"POST\">
              <input style=\"visibility:hidden;display:none;\" type=\"text\" name=\"lesson_choose\" value=\"".$_POST['lesson_choose']."\">
              <input type=\"text\" name=\"delete_comment\" value=".$choice['CommentID']." style=\"visibility:hidden;display:none;\">
              <input type=\"submit\" value=\"Delete this comment\" class=\"add_new_button\">
            </form>";
          }
        }
        if(isset($_SESSION['secretariat']))
        {
          if($_SESSION['secretariat']==1){
            $delete_comment.="
            <form action=\"lesson_show.php\" method=\"POST\">
              <input style=\"visibility:hidden;display:none;\" type=\"text\" name=\"lesson_choose\" value=\"".$_POST['lesson_choose']."\">
              <input type=\"text\" name=\"delete_comment\" value=".$choice['CommentID']." style=\"visibility:hidden;display:none;\">
              <input type=\"submit\" value=\"Delete this comment\" class=\"add_new_button\">
            </form>";
          }
        }
        while($choice5 = $result5->fetch_assoc()){
          if($choice5['Anonymity']==0){
            $total_comment.="
            <div class=\"row\">
              <div class=\"col-md-1\">
                <img src=\"".$choice2['Photo']."\" width=40px>
              </div>
              <div class=\"col-md-3\">
                <h3 style=\"background-color:powderblue;border-radius:30px;font-size:20px;text-align:center;\">".$choice2['LastName']." ".$choice2['FirstName']."</h3>
              </div>
              <div class=\"col-md-3\">
                ".$delete_comment."
              </div>
            </div>
            ";
          }
          else{
            $total_comment.="
            <div class=\"row\">
              <div class=\"col-md-4\">
                <h3 style=\"background-color:powderblue;border-radius:30px;font-size:20px;text-align:center;\">Anonymous User</h3>
              </div>
              <div class=\"col-md-3\">
                ".$delete_comment."
              </div>
            </div>
                ";
          }
        }
      }
      $sql = "SELECT * FROM comments WHERE CommentID=\"".$choice['CommentID']."\"";
      $result3 = $conn->query($sql);
      while($choice3 = $result3->fetch_assoc()){
        $total_comment.="
        <div class=\"row\">
          <div class=\"col-md-7\">
            <p style=\"background-color:LightGray;border-radius:30px;font-size:1em;text-align:left;\" >".$choice3['CommentText']."</p>
          </div>
        </div>";
      }
      $lesson.=$total_comment;
    }
    $lesson.="</div>";
    $conn->close();
    $content="<div class=\"col-md-9\"><div id=\"content\">".$lesson."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
