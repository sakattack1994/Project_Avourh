<?php
function process_file($f){
  $name=$_FILES['file']['name'];
  if($_FILES["file"]["error"]>0){
    $f=2;
  }
  elseif(substr($name, -4)!=".pdf"){
    $f=2;
  }
  else{
    move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/study_guide/'.$_FILES['file']['name']);
    $f=1;
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
    mysqli_set_charset($conn,"utf8");
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "INSERT INTO study_guide VALUES (\"/myDepartment/myresources/study_guide/".$name."\",\"".substr($name,0, -4)."\",\"".substr($name,0, -4)."\");";
    $result = $conn->query($sql);
    $conn->close();
  }
  return $f;
}
if(isset($_POST['delete_study_guide'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  mysqli_set_charset($conn,"utf8");
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  unlink($_SERVER['DOCUMENT_ROOT']."/myDepartment/myresources/study_guide/".$_POST['delete_study_guide']);
  $sql = "DELETE FROM study_guide WHERE id=\"".substr($_POST['delete_study_guide'],0,-4)."\"";
  $result = $conn->query($sql);
  $conn->close();
}
//---------------------------------------------------------------------------------------------------
if(!isset($_SESSION))
    {
      session_start();
    }
  $f=0;
  $alert="";
  if(isset($_FILES["file"]["name"])){
    $f=process_file($f);
  }
  if($f==1){
    $alert="<div class=\"alert alert-success\"><strong>Upload was successfully commited.</strong></div>";
  }elseif ($f==2) {
    $alert="<div class=\"alert alert-danger\"><strong>Upload wasn't commited. Maybe it's not a .pdf file or it's bigger than 10Mb.</strong></div>";
  }
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  mysqli_set_charset($conn,"utf8");
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT url, name FROM study_guide";
  $result = $conn->query($sql);
  $list="";
  while($study_guide = $result->fetch_assoc()){
    $dir = $_SERVER['DOCUMENT_ROOT'] .$study_guide['url'];
    $list.="<option value=\"".basename($dir)."\">".$study_guide['name']."</option>";
  }
  $conn->close();
  if(isset($_POST['study_guides'])){
    $name = $_POST['study_guides'];
  }
  else{
    $name=basename($dir);
  }
  if(isset($_SESSION['secretariat'])){
    $edit=$alert."
    <form enctype=\"multipart/form-data\" action=\"study_guide.php\" method=\"post\">
      <label><h3>Add new study guide:</h3></label>
      <input name=\"file\" type=\"file\" id=\"file\"  >
      <input type=\"submit\" class=\"add_new_button\" value=\"&#9546;Upload\">
    </form>
    <form action=\"study_guide.php\" method=\"post\">
      <label><h3>Select a study guide you want to delete:</h3></label>
      <select name=\"delete_study_guide\" style=\"font-size=25px\">".$list."
      </select>
      <input type=\"submit\" value=\"Delete\">
    </form>
    <br><br>";
  }
  else{
    $edit="";
  }
  $content="
  <div class=\"col-md-9\">
    <div id=\"content\">
      <h1>Study guides</h1>".$edit."
      <label>Choose the study guide you want to see:</label>
      <form action=\"study_guide.php\" method=\"post\">
        <select name=\"study_guides\" style=\"font-size=25px\">".$list."
        </select>
        <input type=\"submit\" value=\"Show\">
      </form>
      <iframe src = \"/myDepartment/javascript/ViewerJS/#../../myresources/study_guide/".$name."\" width=700 height=600 allowfullscreen webkitallowfullscreen></iframe>
    </div>
  </div>
    <div class=\"col-md-3\">
      <div id=\"side_bar\">
    </div>
  </div>";
  include 'WebPageTemplate.php';
?>
