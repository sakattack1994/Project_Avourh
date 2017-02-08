<?php
$alert="";
if(!isset($_SESSION))
    {
      session_start();
    }
if(isset($_POST['new_id'])){
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
  if($_FILES["file"]["name"]){
    move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/secret_pics/'.$_FILES['file']['name']);
    $pic="/myDepartment/myresources/secret_pics/".$_FILES['file']['name'];
  }
  else{
    $pic="/myDepartment/myresources/secret_pics/default.png";
  }
  $sql="INSERT INTO members VALUES
  (\"".$_POST['new_id']."\",
  \"".$_POST['new_pwd']."\",
  \"".$_POST['new_fname']."\",
  \"".$_POST['new_lname']."\",
  \"secretariat\"
  )";
  $result = $conn->query($sql);
  $sql="INSERT INTO secretariat VALUES
  (\"".$_POST['new_id']."\",
  \"".$_POST['new_fname']."\",
  \"".$_POST['new_lname']."\",
  \"".$pic."\",
  \"".$_POST['new_telephone']."\",
  \"".$_POST['new_fax']."\",
  \"".$_POST['new_email']."\"
  )";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The member ".$_POST['new_lname']." ".$_POST['new_fname']." was successfully added.</strong></div>";
}
if(isset($_POST['student_delete'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $sql="SELECT Photo FROM students WHERE StudentID=\"".$_POST['student_delete']."\"";
  $result = $conn->query($sql);
  while($choice = $result->fetch_assoc()){
    if($choice['Photo']!="/myDepartment/myresources/stud_pics/default.png"){
      unlink($_SERVER['DOCUMENT_ROOT'].$choice['Photo']);
    }
  }
  $sql="DELETE FROM students WHERE StudentID=\"".$_POST['student_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM members WHERE ID=\"".$_POST['student_delete']."\"";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The student ".$_POST['student_delete']." was successfully deleted.</strong></div>";
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
  $sql="UPDATE students
  SET StudentID=\"".$_POST['s_id']."\",
  FirstName=\"".$_POST['s_fname']."\",
  LastName=\"".$_POST['s_lname']."\",
  Telephone=\"".$_POST['s_telephone']."\",
  Address=\"".$_POST['s_addr']."\",
  Email=\"".$_POST['s_email']."\",
  LevelOfStudies=\"".$_POST['s_level']."\",
  Semester=\"".$_POST['s_semester']."\"
  WHERE StudentID=\"".$_POST['old_code']."\"
  ";
  $result = $conn->query($sql);
  $pic="";
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
  FirstName=\"".$_POST['s_fname']."\",
  LastName=\"".$_POST['s_lname']."\",
  Password=\"".$_POST['s_pwd']."\"
  WHERE ID=\"".$_POST['old_code']."\"
  ";
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The student ".$_POST['s_lname']." ".$_POST['s_fname']." was successfully updated.</strong></div>";
}
//-----------------------------------------------------------------------------------
$conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
$sql='SET NAMES utf8';
$result = $conn->query($sql);
$table="<table class=\"table table-bordered table-hover\">";
$table.="<form action=\"student_profile.php\" method=\"POST\">";
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
$i=0;
while($stu = $result->fetch_assoc()){
  if($i==0){
    $table.="<tr>";
  }
  $table.="<td align=\"center\"><button type=\"submit\" name=\"stu_choose\" value=".$stu['StudentID']."><font size=\"3px\"><img src=\"".$stu['Photo']."\" width=\"140px\" height=\"150px\">
  <br>".$stu['LastName']." ".$stu['FirstName']."
  <br> ID ".$stu['StudentID']."</font></button>
  </td>";
  $i=$i+1;
  if($i==4){
    $table.="</tr>";
    $i=0;
  }
}
$conn->close();
$table.="</form></table>";
if(isset($_SESSION['secretariat'])){
  $edit="<h3>If you want to add student press here:</h3>
  <form action=\"new_stu_member.php\" method=\"POST\">
    <button type=\"submit\" name=\"stu_member_add\" class=\"add_new_button\">ADD NEW STUDENT</button>
  </form>
  <br>
";
}
else{
  $edit="";
}
$content="
<div class=\"col-md-9\">
  <div id=\"content\">
    <h1>Students</h1><br>
    ".$alert."
    ".$edit."
    ".$table."
    </div>
</div>
  <div class=\"col-md-3\">
    <div id=\"side_bar\">
  </div>
</div>";
include 'WebPageTemplate.php';
?>
