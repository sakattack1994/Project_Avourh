<?php
function process_file($f){
  $name=$_FILES['file']['name'];
  if($_FILES["file"]["error"]>0){
    $f=2;
  }
  elseif(substr($name, -4)!=".txt"){
    $f=2;
  }
  else{
    unlink($_SERVER['DOCUMENT_ROOT']."/myDepartment/myresources/departmentCommittees.txt");
    move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/'.$_FILES['file']['name']);
    rename("myresources/".$_FILES['file']['name'],"myresources/departmentCommittees.txt");
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
    $alert="<div class=\"alert alert-danger\"><strong>Upload wasn't commited. Maybe it's not a .txt file</strong></div>";
  }
  if(isset($_POST['edit'])){
    $txt=$_POST['edit'];
    $myfile = fopen("myresources/departmentCommittees.txt", "w") or die("Unable to open file!");
    ftruncate($myfile, 0);
    fwrite($myfile, $txt);
    fclose($myfile);
    $alert="<div class=\"alert alert-success\"><strong>The edit was successful.</strong></div>";
  }
  $myfile = fopen("myresources/departmentCommittees.txt", "r") or die("Unable to open file!");
  $page=fread($myfile,filesize("myresources/departmentCommittees.txt"));
  $content="<div class=\"col-md-9\"><div id=\"content\">
      ".$page."
      <br>  <br>  <br>
      ".$alert."
      <form action=\"departmentCommittees.php\" id=\"edit_page\" method=\"POST\">
            <h3>If you want to edit this edit this page, enter your text below and press edit:</h3>
            <textarea type=\"text\" rows=\"10\" cols=\"100\" name=\"edit\">".$page."</textarea>
            <br>
            <input type=\"submit\" value=\"EDIT\" class=\"add_new_button\">
      </form>

      <form enctype=\"multipart/form-data\" action=\"departmentCommittees.php\" method=\"post\">
        <label><h3>Replace this page with a new txt file:</h3></label>
        <input name=\"file\" type=\"file\" id=\"file\"  >
        <input type=\"submit\" class=\"add_new_button\" value=\"&#9546;REPLACE\">
      </form>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
  fclose($myfile);
?>
