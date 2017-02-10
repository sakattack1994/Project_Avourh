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
if(isset($_POST['sec_delete'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $sql="SELECT Photo FROM secretariat WHERE SecretariatID=\"".$_POST['sec_delete']."\"";
  $result = $conn->query($sql);
  while($choice = $result->fetch_assoc()){
    if($choice['Photo']!="/myDepartment/myresources/secret_pics/default.png"){
      unlink($_SERVER['DOCUMENT_ROOT'].$choice['Photo']);
    }
  }
  $sql="DELETE FROM secretariat WHERE SecretariatID=\"".$_POST['sec_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM members WHERE ID=\"".$_POST['sec_delete']."\"";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The member ".$_POST['sec_delete']." was successfully deleted.</strong></div>";
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
  $pic="";
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
$table.="<form action=\"secretary_show.php\" method=\"POST\">";
$sql = "SELECT * FROM secretariat";
$result = $conn->query($sql);
$i=0;
while($secr = $result->fetch_assoc()){
  if($i==0){
    $table.="<tr>";
  }
  $table.="<td align=\"center\"><button type=\"submit\" name=\"sec_choose\" value=".$secr['SecretariatID']."><font size=\"3px\"><img src=\"".$secr['Photo']."\" width=\"140px\" height=\"150px\">
  <br>".$secr['LastName']." ".$secr['FirstName']."</font></button>
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
  $edit="<h3>If you want to add new secretariat member press here:</h3>
  <form action=\"new_secr_member.php\" method=\"POST\">
    <button type=\"submit\" name=\"secr_member_add\" class=\"add_new_button\">ADD NEW SECRETARIAT MEMBER</button>
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
    <h1>Secretariat</h1><br>
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
