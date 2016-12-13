<?php
function get_announcement_title($path){
  $file=fopen($path, "r") or die("Unable to open file!");
  $msg=fread($file,filesize($path));
  $res = preg_match("/<h1>(.*)<\/h1>/siU", $msg, $title_matches);
        if (!$res)
            return null;
        $title = preg_replace('/\s+/', ' ', $title_matches[1]);
        $title = trim($title);
  fclose($file);
  return $title;
}
function sort_announcements($a, $b)
{
  return filemtime($a) > filemtime($b) ? -1 : 1;
}
//-----------------------------------------------------------------------------
$alert="";
if(isset($_POST['ann_title'])){
  $dir = $_SERVER['DOCUMENT_ROOT'] .'/dokimes/myresources/announcements/';
  $announcements=scandir($dir);
  $number=count($announcements)-1;
  $file=fopen($dir."ann".$number.".txt", "w") or die("Unable to open file!");
  $h="<h1>".$_POST['ann_title']."</h1>";
  fwrite($file, $h);
  if(count($_FILES['ann_attachments']['name'])==1){
    $tmpFilePath = $_FILES['ann_attachments']['tmp_name'][0];
    if (empty($tmpFilePath)==false){
      $att_title="<h3>Attachments:</h3>";
      fwrite($file, $att_title);
      $dir_of_attachments = $_SERVER['DOCUMENT_ROOT'] .'/dokimes/myresources/attachments/announcements/';
      $at="<a href=\""."myresources/attachments/announcements/".$_FILES["ann_attachments"]["name"][0]."\" download>".$_FILES["ann_attachments"]["name"][0]."</a>";
      fwrite($file, $at);
      move_uploaded_file($_FILES['ann_attachments']['tmp_name'][0],$dir_of_attachments.$_FILES['ann_attachments']['name'][0]);
    }
  }
  elseif (count($_FILES['ann_attachments']['name'])>1) {
    $att_title="<h3>Attachments:</h3>";
    fwrite($file, $att_title);
    $dir_of_attachments = $_SERVER['DOCUMENT_ROOT'] .'/dokimes/myresources/attachments/announcements/';
    for($i=0;$i<count($_FILES['ann_attachments']['name']);$i++){
      $at="<a href=\""."myresources/attachments/announcements/".$_FILES["ann_attachments"]["name"][$i]."\" download>".$_FILES["ann_attachments"]["name"][$i]."</a>";
      fwrite($file, $at."<br><br>");
      move_uploaded_file($_FILES['ann_attachments']['tmp_name'][$i],$dir_of_attachments.$_FILES['ann_attachments']['name'][$i]);
    }
  }
  $con="<p>".$_POST['ann_content']."</p>";
  fwrite($file, $con);
  fclose($file);
  $alert="<div class=\"alert alert-success\"><strong>Announcement was successfully added.</strong></div>";
}
//-----------------------------------------------------------------------------
$dir = $_SERVER['DOCUMENT_ROOT'] .'/dokimes/myresources/announcements/';
$announcements=scandir($dir);
for($i=2;$i<count($announcements);$i++){
  $files[$i-2]=$dir.$announcements[$i];
}
usort($files, "sort_announcements");
$list="";
for($i=2;$i<count($announcements);$i++){
  $title=get_announcement_title($files[$i-2]);
  $date=date("F d Y H:i:s.",filemtime($files[$i-2]));
  $list.="
  <tr>
    <td class=announcement id=".basename($files[$i-2])."><strong>".$title."</strong></td>
    <td>".$date."</td>
  </tr>";
}
  $content="<div class=\"col-md-9\"><div id=\"content\">
  <h1>Announcements</h1>".$alert."




  <h3>If you want to add new announcement press here:</h3>
  <a href=\"add_announcement.php\"><button type=button class=\"add_new_button\">&#9546;Add New</button></a>








  <table class=\"table table-bordered table-hover\">
  <thead>
    <tr>
      <th>Title</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>".$list."</tbody>
</table>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
