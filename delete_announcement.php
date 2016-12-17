<?php
  if(isset($_POST['delete_announcement'])){
      $conn = new mysqli('localhost', 'root', '', 'mydepartment');
        // Check connection
      if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
      $sql='SET NAMES utf8';
      $result = $conn->query($sql);
      $sql = "DELETE FROM announcements WHERE ID=\"".$_POST['delete_announcement']."\"";
      $result = $conn->query($sql);
      $sql = "SELECT dir FROM attachments WHERE ID=\"".$_POST['delete_announcement']."\"";
      $result = $conn->query($sql);
      while($dir = $result->fetch_assoc()){
        unlink($_SERVER[DOCUMENT_ROOT].$dir['dir']);
      }
      $sql = "DELETE FROM attachments WHERE ID=\"".$_POST['delete_announcement']."\"";
      $result = $conn->query($sql);
      $conn->close();
  }


  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
    // Check connection
  if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql = "SELECT ID,Header FROM announcements";
  $result = $conn->query($sql);
  $list="";
  while($announcement = $result->fetch_assoc()){
      $list.="<option value=\"".$announcement['ID']."\">".$announcement['Header']."</option>";
  }
  $conn->close();

  $content="
  <div class=\"col-md-9\">
    <div id=\"content\">
      <form action=\"delete_announcement.php\" method=\"post\">
        <label><h3>Select an announcement you want to delete, included the attachments:</h3></label>
        <br>
        <select name=\"delete_announcement\" style=\"font-size=200px\">".$list."
        </select>
        <input type=\"submit\" value=\"Delete\">
      </form>
      <br>
      <a href=\"announcements.php\"><button id=back_announcements>&#8592;Back to announcements</button></a>
    </div>
  </div>
    <div class=\"col-md-3\">
      <div id=\"side_bar\">
    </div>
  </div>";
  include 'WebPageTemplate.php';
?>
