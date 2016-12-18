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

if(isset($_POST['delete_announcement'])){
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT dir FROM attachments WHERE ID=\"".$_POST['delete_announcement']."\"";
    $result = $conn->query($sql);
    while($dir = $result->fetch_assoc()){
      unlink($_SERVER['DOCUMENT_ROOT'].$dir['dir']);
    }
    $sql = "DELETE FROM attachments WHERE ID=\"".$_POST['delete_announcement']."\"";
    $result = $conn->query($sql);
    $sql = "DELETE FROM announcements WHERE ID=\"".$_POST['delete_announcement']."\"";
    $result = $conn->query($sql);
    $conn->close();
    $alert="<div class=\"alert alert-success\"><strong>Announcement was successfully deleted.</strong></div>";
}

//-----------------------------------------------------------------------------
$conn = new mysqli('localhost', 'root', '', 'mydepartment');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql='SET NAMES utf8';
$result = $conn->query($sql);
if(isset($_POST['announcement_category'])){
  if($_POST['announcement_category']=="all"){
    $sql = "SELECT ID,Header, date FROM announcements ORDER BY date DESC";
  }
  else{
    $sql = "SELECT ID,Header, date FROM announcements WHERE Category=\"".$_POST['announcement_category']."\" ORDER BY date DESC";
  }
}
else{
  $sql = "SELECT ID,Header, date FROM announcements ORDER BY date DESC";
}
$result = $conn->query($sql);
$list="";
while($announcement = $result->fetch_assoc()){
  $list.="
  <tr>
    <td class=announcement id=".$announcement['ID']."><strong>".$announcement['Header']."</strong></td>
    <td>".$announcement['date']."</td>
    <td><form action=\"announcements.php\" method=\"POST\"><button type=\"submit\" name=\"delete_announcement\" value=".$announcement['ID']."><img src=\"images/x.png\" width=25px></button></form></td>
  </tr>";
}
$conn->close();
$delete="<th>Delete</th>";
$content="<div class=\"col-md-9\"><div id=\"content\">
  <h1>Announcements</h1>".$alert."



  <h3>If you want to add new announcement press here:</h3>
  <a href=\"add_announcement.php\"><button type=button class=\"add_new_button\">&#9546;Add New</button></a>
  <br> <br>


  <form action=\"announcements.php\" method=\"POST\">
    <label style=\"font-size:25px\">Sort by:</label>
    <select name=\"announcement_category\" style=\"font-size=50px;\">
      <option value=\"all\">All</option>
      <option value=\"Graduate studies\">Graduate studies</option>
      <option value=\"Postgraduate\">Postgraduate</option>
      <option value=\"Phd studies\">Phd studies</option>
      <option value=\"Scholarships\">Scholarships</option>
      <input type=submit value=\"Sort announcements\">
    </select>
  </form>
  <table class=\"table table-bordered table-hover\">
  <thead>
    <tr>
      <th>Title</th>
      <th>Date</th>
      ".$delete."
    </tr>
  </thead>
  <tbody>".$list."</tbody>
</table>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
