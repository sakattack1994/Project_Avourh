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
    move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/dokimes/myresources/study_guide/'.$_FILES['file']['name']);
    $f=1;
  }
  return $f;
}
//---------------------------------------------------------------------------------------------------
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
  $dir = $_SERVER['DOCUMENT_ROOT'] .'/dokimes/myresources/study_guide/';
  $study_guides=scandir($dir);
  $name=$study_guides[count($study_guides)-1];
  if(isset($_POST['study_guides'])){
    $name = $_POST['study_guides'];
  }
  $list="";
  for($i=2;$i<count($study_guides);$i++){
    $list.="<option value=\"".$study_guides[$i]."\">".$study_guides[$i]."</option>";
  }
  $content="
  <div class=\"col-md-9\">
    <div id=\"content\">
      <h1>Study guides</h1>


      ".$alert."
      <form enctype=\"multipart/form-data\" action=\"study_guide.php\" method=\"post\">
        <label><h3>Add new study guide:</h3></label>
        <input name=\"file\" type=\"file\" id=\"file\"  >
        <input type=\"submit\" class=\"add_new_button\" value=\"&#9546;Upload\">
      </form>






      <label>Choose the study guide you want to see:</label>
      <form action=\"study_guide.php\" method=\"post\">
        <select name=\"study_guides\" style=\"font-size=25px\">".$list."
        </select>
        <input type=\"submit\" value=\"Show\">
      </form>
      <iframe src = \"/dokimes/javascript/ViewerJS/#../../myresources/study_guide/".$name."\" width=700 height=600 allowfullscreen webkitallowfullscreen></iframe>
    </div>
  </div>
    <div class=\"col-md-3\">
      <div id=\"side_bar\">
    </div>
  </div>";
  include 'WebPageTemplate.php';
?>
