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
    <td class=announcement id=".$announcements[$i]."><strong>".$title."</strong></td>
    <td>".$date."</td>
  </tr>";
}














  $content="<div class=\"col-md-9\"><div id=\"content\">
  <h1>Announcements</h1>
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
