<?php
if(!isset($_SESSION))
    {
      session_start();
    }
$alert="";
if(isset($_POST['pub_delete'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql="DELETE FROM scientificpublications WHERE PublicationID=\"".$_POST['pub_delete']."\"";
  $result2 = $conn->query($sql);
  $sql="DELETE FROM professors_publications WHERE PublicationID=\"".$_POST['pub_delete']."\"";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The scientific publication was successfully deleted.</strong></div>";
}
if(isset($_POST['edit_title'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql="UPDATE scientificpublications
  SET Title=\"".$_POST['edit_title']."\",
  YearOfPublish=\"".$_POST['edit_date']."\",
  Description=\"".$_POST['edit_description']."\"
  WHERE PublicationID=\"".$_POST['pub_id']."\"
  ";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The scientific publication was successfully updated.</strong></div>";
}
if(isset($_POST['new_title'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $id="pub_".strftime("%m/%d/%y",time()).time();
  $sql="INSERT INTO scientificpublications VALUES(\"".$id."\",\"".$_POST['new_title']."\",\"".$_POST['new_date']."\",\"".$_POST['new_description']."\") ";
  $result = $conn->query($sql);
  $sql="INSERT INTO professors_publications VALUES(\"".$_SESSION['user']."\",\"".$id."\") ";
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The scientific publication was successfully added.</strong></div>";
}
$conn = new mysqli('localhost', 'root', '', 'mydepartment');
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql='SET NAMES utf8';
$result = $conn->query($sql);
$edit="<h3>If you want to add a new scientific publication press here:</h3>
<form action=\"new_publication.php\" method=\"POST\">
  <button type=\"submit\" class=\"add_new_button\">ADD NEW SCIENTIFIC PUBLICATION</button>
</form>
<br>
";
$list=" ";
$list.="
  <table class=\"table table-bordered table-hover\">
  <thead>
    <tr style=\"background-color:rgb(41,127,184);\";>
      <th colspan=2 style=\"text-align: center;\"><font color=\"#fff\">My publications</font></th>
      </tr>
  </thead>
  <tbody><tr><td>";
  $sql="SELECT PublicationID FROM professors_publications WHERE ProfessorID=\"".$_SESSION['user']."\"";
  $result = $conn->query($sql);
  while($pub_id = $result->fetch_assoc()){
    $sql="SELECT Title,YearOfPublish FROM scientificpublications WHERE PublicationID=\"".$pub_id['PublicationID']."\"";
    $result2 = $conn->query($sql);
    while($pub = $result2->fetch_assoc()){
        $list.="<button type=\"submit\" name=\"publication_id\" value=".$pub_id['PublicationID']."><font size=\"2px\">".$pub['Title']." published at ".$pub['YearOfPublish']."</font></button><br>";
    }
  }
  $list.="</td><td></tbody></table>";
$conn->close();
$content="<div class=\"col-md-9\"><div id=\"content\">
  <h1>My scientific publications</h1>".$alert."
  ".$edit."
  <form action=\"publication_show.php\" method=\"POST\">
  <br>
  ".$list."</form>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
