<?php
if(!isset($_SESSION))
    {
      session_start();
    }
if(isset($_POST['prof_choose'])){
  if(!isset($_SESSION))
      {
        session_start();
      }
    $prof="";
    $prof.="<div class=\"container\">";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $publications="";
    $sql = "SELECT * FROM professors_publications WHERE ProfessorID=\"".$_POST['prof_choose']."\"";
    $result = $conn->query($sql);
    while($choice = $result->fetch_assoc()){
      $sql = "SELECT * FROM scientificpublications WHERE PublicationID=\"".$choice['PublicationID']."\"";
      $result2 = $conn->query($sql);
      while($choice2 = $result2->fetch_assoc()){
        $publications.=$choice2['Title']." published at ".$choice2['YearOfPublish']."<br>";
      }
    }
    $lessons="";
    $sql = "SELECT * FROM professor_lessons_thisyear WHERE ProfessorID=\"".$_POST['prof_choose']."\"";
    $result = $conn->query($sql);
    while($choice = $result->fetch_assoc()){
      $sql = "SELECT * FROM lessons WHERE LessonID=\"".$choice['LessonID']."\"";
      $result2 = $conn->query($sql);
      while($choice2 = $result2->fetch_assoc()){
        $lessons.="<button type=\"submit\" name=\"lesson_choose\" value=".$choice2['LessonID']."><font size=\"3px\">".$choice2['LessonID']." : ".$choice2['Title']."</font></button><br>";
      }
    }
    $sql = "SELECT * FROM professors WHERE ProfessorID=\"".$_POST['prof_choose']."\"";
    $result = $conn->query($sql);
    if(isset($_SESSION['user'])){
      if($_SESSION['user']==$_POST['prof_choose']){
        $edit="<div class=\"row\">
            <div class=\"col-md-8\">
              <h3>If you want to edit your profile press here:</h3>
              </div>
            </div>
            <div class=\"row\">
            <div class=\"col-md-8\">
              <form action=\"edit_member.php\" method=\"POST\">
                <button type=\"submit\" name=\"professor_edit\" value=".$_POST['prof_choose']." class=\"add_new_button\">EDIT PROFILE</button>
                </form>
            </div>
          </div>";
        }
        else if (isset($_SESSION['secretariat'])) {
          $edit="<div class=\"row\">
            <div class=\"col-md-8\">
              <h3>If you want to delete this professor press here:</h3>
            </div>
          </div>
          <div class=\"row\">
            <div class=\"col-md-8\">
              <form action=\"faculty_show.php\" method=\"POST\">
                <button type=\"submit\" name=\"professor_delete\" value=".$_POST['prof_choose']." class=\"add_new_button\">DELETE PROFESSOR</button>
              </form>
            </div>
          </div>";
        }
        else{
          $edit="";
        }
    }
    else{
      $edit="";
    }
    while($choice = $result->fetch_assoc()){
      $prof.=
      $edit."
      <div class=\"row\">
          <div class=\"col-md-8\"><h1>".$choice['LastName']." ".$choice['FirstName']."</h1></div>
      </div><br><br>
      <div class=\"row\">
          <div class=\"col-md-2\"><img src=\"".$choice['Photo']."\" width=\"180px\" height=\"190px\"></div>
          <div class=\"col-md-6\">
            <h3>".$choice['LastName']." ".$choice['FirstName'].", ".$choice['Role']."</h3>
            <p>Sector: ".$choice['Sector']."</p>
            <p>Site:<a href=\"".$choice['Website']."\">".$choice['LastName']." home page</a></p>
            <p>Telephone: ".$choice['Telephone']."</p>
            <p>Fax: ".$choice['Fax']."</p>
            <p>Email: ".$choice['Email']."</p>
            <p>Google Scholar:<a href=\"".$choice['GoogleScholar']."\">".$choice['GoogleScholar']."</a></p>
          </div>
      </div>
      <div class=\"row\">
          <div class=\"col-md-8\">
            <h2>Hours for students:</h2>
            <p>".$choice['ΗoursForStudents']."</p>
          </div>
      </div>
      <div class=\"row\">
          <div class=\"col-md-8\">
          <h1>Resume:</h1>
          <p>".$choice['Resume']."</p>
          </div>
      </div><br>
      <div class=\"row\">
          <div class=\"col-md-8\">
          <h1>Scientific Publications:</h1>
          <p>".$publications."</p>
          </div>
      </div><br>
      <div class=\"row\">
          <div class=\"col-md-8\">
          <h1>Teaching:</h1>
          <p><form action=\"lesson_show.php\" method=\"POST\">".$lessons."</form></p>
          </div>
      </div><br>
      ";
    }
    $conn->close();
    $prof.="</div>";
    $content="<div class=\"col-md-9\"><div id=\"content\">".$prof."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
