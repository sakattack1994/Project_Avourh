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
    move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/prof_pics/'.$_FILES['file']['name']);
    $pic="/myDepartment/myresources/prof_pics/".$_FILES['file']['name'];
  }
  else{
    $pic="/myDepartment/myresources/prof_pics/default.png";
  }
  $sql="INSERT INTO members VALUES
  (\"".$_POST['new_id']."\",
  \"".$_POST['new_pwd']."\",
  \"".$_POST['new_fname']."\",
  \"".$_POST['new_lname']."\",
  \"prof\"
  )";
  $result = $conn->query($sql);
  $sql="INSERT INTO professors VALUES
  (\"".$_POST['new_id']."\",
  \"".$_POST['new_fname']."\",
  \"".$_POST['new_lname']."\",
  \"".$_POST['new_role']."\",
  \"".$pic."\",
  \"".$_POST['new_resume']."\",
  \"".$_POST['new_sector']."\",
  \"".$_POST['new_telephone']."\",
  \"".$_POST['new_fax']."\",
  \"".$_POST['new_email']."\",
  \"".$_POST['new_hours']."\",
  \"".$_POST['new_website']."\",
  \"".$_POST['new_google']."\"
  )";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The member ".$_POST['new_lname']." ".$_POST['new_fname']." was successfully added.</strong></div>";
}
if(isset($_POST['professor_delete'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $sql="SELECT Photo FROM professors WHERE ProfessorID=\"".$_POST['professor_delete']."\"";
  $result = $conn->query($sql);
  while($choice = $result->fetch_assoc()){
    if($choice['Photo']!="/myDepartment/myresources/prof_pics/default.png"){
      unlink($_SERVER['DOCUMENT_ROOT'].$choice['Photo']);
    }
  }
  $sql="DELETE FROM professor_lessons_thisyear WHERE ProfessorID=\"".$_POST['professor_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM professor_lessons_lastyears WHERE ProfessorID=\"".$_POST['professor_delete']."\"";
  $result = $conn->query($sql);
  $sql="SELECT * FROM professors_publications WHERE ProfessorID=\"".$_POST['professor_delete']."\"";
  $result = $conn->query($sql);
  while($choice = $result->fetch_assoc()){
    $sql="DELETE FROM scientificpublications WHERE PublicationID=\"".$choice['PublicationID']."\"";
    $result2 = $conn->query($sql);
  }
  $sql="DELETE FROM professors_publications WHERE ProfessorID=\"".$_POST['professor_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM members WHERE ID=\"".$_POST['professor_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM professors WHERE ProfessorID=\"".$_POST['professor_delete']."\"";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The member ".$_POST['professor_delete']." was successfully deleted.</strong></div>";
}
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
  $sql="UPDATE professors
  SET ProfessorID=\"".$_POST['p_id']."\",
  FirstName=\"".$_POST['p_fname']."\",
  LastName=\"".$_POST['p_lname']."\",
  Role=\"".$_POST['p_role']."\",
  Resume=\"".$_POST['p_resume']."\",
  Sector=\"".$_POST['p_sector']."\",
  Telephone=\"".$_POST['p_telephone']."\",
  Fax=\"".$_POST['p_fax']."\",
  Email=\"".$_POST['p_email']."\",
  ΗoursForStudents=\"".$_POST['p_hours']."\",
  Website=\"".$_POST['p_website']."\",
  GoogleScholar=\"".$_POST['p_google']."\"
  WHERE ProfessorID=\"".$_POST['old_code']."\"
  ";
  $result = $conn->query($sql);
  $pic="";
  if($_FILES["file"]["name"]){
    move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/prof_pics/'.$_FILES['file']['name']);
    $pic="/myDepartment/myresources/prof_pics/".$_FILES['file']['name'];
    $sql="UPDATE professors
    SET Photo=\"".$pic."\"
    WHERE ProfessorID=\"".$_POST['p_id']."\"
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
  $sql="UPDATE professors_publications
  SET ProfessorID=\"".$_POST['p_id']."\"
  WHERE ProfessorID=\"".$_POST['old_code']."\"
  ";
  $result = $conn->query($sql);
  $sql="UPDATE professor_lessons_lastyears
  SET ProfessorID=\"".$_POST['p_id']."\"
  WHERE ProfessorID=\"".$_POST['old_code']."\"
  ";
  $result = $conn->query($sql);
  $sql="UPDATE professor_lessons_thisyear
  SET ProfessorID=\"".$_POST['p_id']."\"
  WHERE ProfessorID=\"".$_POST['old_code']."\"
  ";
  $result = $conn->query($sql);
  $i=1;
  while(true){
    if(isset($_POST['pub_title'.$i])){
    $sql="UPDATE scientificpublications
    SET Title=\"".$_POST['pub_title'.$i]."\",
    YearOfPublish=\"".$_POST['pub_year'.$i]."\"
    WHERE PublicationID=\"".$_POST['pub_id']."\"
    ";
    $result = $conn->query($sql);
  }
  else{
    break;
  }
  $i=$i+1;
  }
  $i=1;
  while(true){
    if(isset($_POST['pub_title_new'.$i])){
      $id="pub_".strftime("%m/%d/%y",time()).time().$i;
      $sql="INSERT INTO scientificpublications VALUES(\"".$id."\",\"".$_POST['pub_title_new'.$i]."\",\"".$_POST['pub_year_new'.$i]."\") ";
      $result = $conn->query($sql);
      $sql="INSERT INTO professors_publications VALUES(\"".$_POST['p_id']."\",\"".$id."\") ";
      $result = $conn->query($sql);
    }
    else{
      break;
    }
    $i=$i+1;
  }
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The member ".$_POST['p_lname']." ".$_POST['p_fname']." was successfully updated.</strong></div>";
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
$table.="<form action=\"professor_show.php\" method=\"POST\">";
$sql = "SELECT * FROM professors WHERE Role=\"Καθηγητής\"";
$result = $conn->query($sql);
$i=0;
while($prof = $result->fetch_assoc()){
  if($i==0){
    $table.="<tr>";
  }
  $table.="<td align=\"center\"><button type=\"submit\" name=\"prof_choose\" value=".$prof['ProfessorID']."><font size=\"3px\"><img src=\"".$prof['Photo']."\" width=\"140px\" height=\"150px\">
  <br>".$prof['LastName']." ".$prof['FirstName']."</font></button><br>
  ".$prof['Role']."<br>
  ".$prof['Sector']."
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
  $edit="<h3>If you want to add a new professor press here:</h3>
  <form action=\"new_member.php\" method=\"POST\">
    <button type=\"submit\" name=\"member_add\" class=\"add_new_button\">ADD NEW PERSONEL MEMBER</button>
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
    <h1>Faculty</h1><br>
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
