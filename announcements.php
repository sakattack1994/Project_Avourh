<?php
$alert="";
if(isset($_POST['ann_title'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $id="ann_".strftime("%m/%d/%y",time()).time();
  $sql = "INSERT INTO announcements VALUES(\"".$id."\",\"".$_POST['ann_title']."\",\"".$_POST['ann_content']."\",\"".$_POST['ann_category']."\",CURRENT_TIMESTAMP)";
  $result = $conn->query($sql);

  if(count($_FILES['ann_attachments']['name'])==1){
    $tmpFilePath = $_FILES['ann_attachments']['tmp_name'][0];
    if (empty($tmpFilePath)==false){
      $dir_of_attachments = $_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/attachments/announcements/';
      $sql = "INSERT INTO attachments VALUES(\"".$id."\",\"/myDepartment/myresources/attachments/announcements/".$_FILES["ann_attachments"]["name"][0]."\")";
      $result = $conn->query($sql);
      move_uploaded_file($_FILES['ann_attachments']['tmp_name'][0],$dir_of_attachments.urlencode($_FILES['ann_attachments']['name'][0]));
    }
  }
  elseif (count($_FILES['ann_attachments']['name'])>1) {
    $dir_of_attachments = $_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/attachments/announcements/';
    for($i=0;$i<count($_FILES['ann_attachments']['name']);$i++){
      $sql = "INSERT INTO attachments VALUES(\"".$id."\",\"/myDepartment/myresources/attachments/announcements/".$_FILES["ann_attachments"]["name"][$i]."\")";
      $result = $conn->query($sql);
      move_uploaded_file($_FILES['ann_attachments']['tmp_name'][$i],$dir_of_attachments.urlencode($_FILES['ann_attachments']['name'][$i]));
    }
  }
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>Announcement was successfully added.</strong></div>";
}
//-----------------------------------------------------------------------------
$conn = new mysqli('localhost', 'root', '', 'mydepartment');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql='SET NAMES utf8';
$result = $conn->query($sql);
$sql = "SELECT ID,Header, date FROM announcements ORDER BY date DESC";
$result = $conn->query($sql);
$list="";
while($announcement = $result->fetch_assoc()){
  $list.="
  <tr>
    <td class=announcement id=".$announcement['ID']."><strong>".$announcement['Header']."</strong></td>
    <td>".$announcement['date']."</td>
  </tr>";
}
$conn->close();
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
