<?php
if(!isset($_SESSION))
    {
      session_start();
    }
if(isset($_POST['stu_choose'])){
    $secr="";
    $secr.="<div class=\"container\">";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM students WHERE StudentID=\"".$_POST['stu_choose']."\"";
    $result = $conn->query($sql);
    if(isset($_SESSION['user'])){
      if($_SESSION['user']==$_POST['stu_choose']){
        $edit="<div class=\"row\">
            <div class=\"col-md-8\">
              <h3>If you want to edit your profile press here:</h3>
              </div>
            </div>
            <div class=\"row\">
            <div class=\"col-md-8\">
              <form action=\"edit_student.php\" method=\"POST\">
                <button type=\"submit\" name=\"student_edit\" value=".$_POST['stu_choose']." class=\"add_new_button\">EDIT PROFILE</button>
                </form>
            </div>
          </div>";
        }
        else if (isset($_SESSION['secretariat'])) {
          if($_SESSION['secretariat']==1){
            $edit="<div class=\"row\">
                <div class=\"col-md-8\">
                  <h3>If you want to edit the profile press here:</h3>
                  </div>
                </div>
                <div class=\"row\">
                <div class=\"col-md-8\">
                  <form action=\"edit_student.php\" method=\"POST\">
                    <button type=\"submit\" name=\"student_edit\" value=".$_POST['stu_choose']." class=\"add_new_button\">EDIT PROFILE</button>
                    </form>
                </div>
              </div>
            <div class=\"row\">
              <div class=\"col-md-8\">
                <h3>If you want to delete this student from the system press here:</h3>
              </div>
            </div>
            <div class=\"row\">
              <div class=\"col-md-8\">
                <form action=\"all_students.php\" method=\"POST\">
                  <button type=\"submit\" name=\"student_delete\" value=".$_POST['stu_choose']." class=\"add_new_button\">DELETE PROFESSOR</button>
                </form>
              </div>
            </div>";
          }
        }
        else{
          $edit="";
        }
    }
    else{
      $edit="";
    }
    while($choice = $result->fetch_assoc()){
      $level="";
      if($choice['LevelOfStudies']==-1){
        $level="Pregraduate";
      }
      else if($choice['LevelOfStudies']==1){
        $level="Postgraduate";
      }
      else{
        $level="Doctora";
      }
      $secr.=
      $edit."
      <div class=\"row\">
          <div class=\"col-md-8\"><h1>".$choice['LastName']." ".$choice['FirstName']."</h1></div>
      </div><br><br>
      <div class=\"row\">
          <div class=\"col-md-2\"><img src=\"".$choice['Photo']."\" width=\"180px\" height=\"190px\"></div>
          <div class=\"col-md-6\">
            <h3>".$choice['LastName']." ".$choice['FirstName']."</h3>
            <p>Telephone: ".$choice['Telephone']."</p>
            <p>Address: ".$choice['Address']."</p>
            <p>Email: ".$choice['Email']."</p>
            <p>LevelOfStudies: ".$level."</p>
            <p>Semester: ".$choice['Semester']."</p>
          </div>
      </div>
      <br><br>
      ";
    }
    $conn->close();
    $secr.="</div>";
    $content="<div class=\"col-md-9\"><div id=\"content\">".$secr."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
