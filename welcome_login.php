<?php
if(!isset($_SESSION))
    {
      session_start();
    }
$alert="";
if(isset($_POST['p_id'])){
      $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $sql='SET NAMES utf8';
      $result = $conn->query($sql);
      $sql='SET FOREIGN_KEY_CHECKS=0';
      $result = $conn->query($sql);
      $pic="";
      $sql="UPDATE secretariat
      SET SecretariatID=\"".$_POST['p_id']."\",
      FirstName=\"".$_POST['p_fname']."\",
      LastName=\"".$_POST['p_lname']."\",
      Telephone=\"".$_POST['p_telephone']."\",
      Fax=\"".$_POST['p_fax']."\",
      Email=\"".$_POST['p_email']."\"
      WHERE SecretariatID=\"".$_POST['old_code']."\"
      ";
      $result = $conn->query($sql);
      if($_FILES["file"]["name"]){
        move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/secret_pics/'.$_FILES['file']['name']);
        $pic="/myDepartment/myresources/secret_pics/".$_FILES['file']['name'];
        $sql="UPDATE secretariat
        SET Photo=\"".$pic."\"
        WHERE SecretariatID=\"".$_POST['p_id']."\"
        ";
        $result = $conn->query($sql);
      }
      $sql="UPDATE members
      SET ID=\"".$_POST['p_id']."\",
      FirstName=\"".$_POST['p_fname']."\",
      LastName=\"".$_POST['p_lname']."\",
      Password=\"".$_POST['p_pwd']."\"
      WHERE ID=\"".$_POST['old_code']."\"
      ";
      $result = $conn->query($sql);
      $sql='SET FOREIGN_KEY_CHECKS=1';
      $result = $conn->query($sql);
      $conn->close();
      $_SESSION['user']=$_POST['p_id'];
      $alert="<div class=\"alert alert-success\"><strong>You have successfully updated your profile.</strong></div>";
}
if(isset($_POST['s_id'])){
      $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
      $sql='SET NAMES utf8';
      $result = $conn->query($sql);
      $sql='SET FOREIGN_KEY_CHECKS=0';
      $result = $conn->query($sql);
      $pic="";
      $extra_info="";
      if(isset($_SESSION['secretariat']))
      {
        if($_SESSION['secretariat']==1){

          $extra_info="
          Semester=\"".$_POST['p_semester']."\"
          LevelOfStudies=\"".$_POST['p_level']."\"
          ";
        }
      }
      $sql="UPDATE students
      SET StudentID=\"".$_POST['s_id']."\",
      FirstName=\"".$_POST['p_fname']."\",
      LastName=\"".$_POST['p_lname']."\",
      Telephone=\"".$_POST['p_telephone']."\",
      Address=\"".$_POST['p_addr']."\",
      Email=\"".$_POST['p_email']."\"
      ".$extra_info."
      WHERE StudentID=\"".$_POST['old_code']."\"
      ";
      $result = $conn->query($sql);
      if($_FILES["file"]["name"]){
        move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/stud_pics/'.$_FILES['file']['name']);
        $pic="/myDepartment/myresources/stud_pics/".$_FILES['file']['name'];
        $sql="UPDATE students
        SET Photo=\"".$pic."\"
        WHERE StudentID=\"".$_POST['s_id']."\"
        ";
        $result = $conn->query($sql);
      }
      $sql="UPDATE members
      SET ID=\"".$_POST['s_id']."\",
      FirstName=\"".$_POST['p_fname']."\",
      LastName=\"".$_POST['p_lname']."\",
      Password=\"".$_POST['p_pwd']."\"
      WHERE ID=\"".$_POST['old_code']."\"
      ";
      $result = $conn->query($sql);
      $sql='SET FOREIGN_KEY_CHECKS=1';
      $result = $conn->query($sql);
      $conn->close();
      $_SESSION['user']=$_POST['s_id'];
      $alert="<div class=\"alert alert-success\"><strong>You have successfully updated your profile.</strong></div>";
}
//---------------------------------------------------------------------------------------------------------------------------------
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $textaki="";
    if(isset($_SESSION['prof']))
    {
      if($_SESSION['prof']==1){
        $table='professors';
        $table1='Professor';
        $textaki="Welcome to the myDepartment online application of Electrical and Computer enginneering of university of Patras.
        This is your profile. Here you can:<br>-see and modify the lessons you are teaching this current academic year<br>-see the
        evaluation about each of them from the students and have a perspective of their opinion about them<br>-see your verified
        publications and modify them as you wish.
        ";
      }
    }
    if(isset($_SESSION['secretariat']))
    {
      if($_SESSION['secretariat']==1){
        $table='secretariat';
        $table1='Secretariat';
        $textaki="Welcome to the myDepartment online application of Electrical and Computer enginneering of university of Patras.
        This is your profile. Here you can:<br>-Add new announcements to inform the community<br>-Add new personnel members
        such as professors etc<br>-Manage the secretary members of our department<br>-Manage the students of our department
        <br>-Create a new study schedule for the new academic year<br>-Add new lessons to the department<br>-Add new books and
        attach them to lessons
        ";
      }
    }
    if(isset($_SESSION['student']))
    {
      if($_SESSION['student']==1){
        $table='students';
        $table1='Student';
        $textaki="Welcome to the myDepartment online application of Electrical and Computer enginneering of university of Patras.
        This is your profile. Here you can:<br>-Edit your profile<br>-See all the lessons of our department and enroll to those you
        wish to watch<br>-Evaluate the lessons you watch<br>-See the calendar to find the days that you have lectures of the lessons you have
        enrolled to
        ";
      }
    }
    $yourname="";
    $sql = "SELECT * FROM ".$table." WHERE ".$table1."ID=\"".$_SESSION['user']."\"";
    $result = $conn->query($sql);
    while($choice = $result->fetch_assoc()){
      $yourname=$choice['LastName']." ".$choice['FirstName'];
    }
    $conn->close();
    $content="<div class=\"col-md-9\"><div id=\"content\">
      ".$alert."
      <h1>Welcome ".$yourname."</h1>
      <p>".$textaki."</p>
      <br>  <br>  <br>
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
?>
