<?php
if(!isset($_SESSION))
    {
      session_start();
    }

function process_file($f){
  $name=$_FILES['file']['name'];
  if($_FILES["file"]["error"]>0){
    $f=2;
  }
  elseif(substr($name, -4)!=".pdf"){
    $f=2;
  }
  else{
    unlink($_SERVER['DOCUMENT_ROOT']."/myDepartment/myresources/pdf/graduaterules2016.pdf");
    move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/pdf/'.$_FILES['file']['name']);
    rename("myresources/pdf/".$_FILES['file']['name'],"myresources/pdf/graduaterules2016.pdf");
    $f=1;
  }
  return $f;
}
  $f=0;
  $alert="";
  if(isset($_FILES["file"]["name"])){
    $f=process_file($f);
  }
  if($f==1){
    $alert="<div class=\"alert alert-success\"><strong>Upload was successfully commited.</strong></div>";
  }elseif ($f==2) {
    $alert="<div class=\"alert alert-danger\"><strong>Upload wasn't commited. Maybe it's not a .pdf file</strong></div>";
  }

  if(isset($_SESSION['secretariat'])){
    $edit="<form enctype=\"multipart/form-data\" action=\"graduation_rules.php\" method=\"post\">
        <label><h3>Replace the current pdf with a new pdf file:</h3></label>
        <input name=\"file\" type=\"file\" id=\"file\"  >
        <input type=\"submit\" class=\"add_new_button\" value=\"&#9546;REPLACE\">
      </form>";
  }
  else{
    $edit="";
  }

$content="
<div class=\"col-md-9\">
  <div id=\"content\">
    <h1>Graduation Rules</h1>
    <br>
    ".$alert.$edit."
    <br> <br>
    <iframe src = \"/myDepartment/javascript/ViewerJS/#../../myresources/pdf/graduaterules2016.pdf\" width=700 height=600 allowfullscreen webkitallowfullscreen></iframe>
  </div>
</div>
  <div class=\"col-md-3\">
    <div id=\"side_bar\">
  </div>
</div>";
include 'WebPageTemplate.php';
?>
