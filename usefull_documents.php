<?php
if(!isset($_SESSION))
    {
      session_start();
    }

if(isset($_FILES["file"]["name"])){
  move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/usefull documents/'.$_FILES['file']['name']);
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  mysqli_set_charset($conn,"utf8");
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql = "INSERT INTO usefull_documents VALUES (\"/myDepartment/myresources/usefull documents/".$_FILES['file']['name']."\",\"".substr($_FILES['file']['name'],0, -4)."\",\"".$_POST['doc_category']."\");";
  $result = $conn->query($sql);
  $conn->close();
}
if(isset($_POST['delete_doc'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  mysqli_set_charset($conn,"utf8");
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  //unlink($_SERVER['DOCUMENT_ROOT'].$_POST['delete_doc']);
  $sql = "DELETE FROM usefull_documents WHERE dir=\"".$_POST['delete_doc']."\"";
  $result = $conn->query($sql);
  $conn->close();
}

$conn = new mysqli('localhost', 'root', '', 'mydepartment');
mysqli_set_charset($conn,"utf8");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql='SET NAMES utf8';
$result = $conn->query($sql);
$sql = "SELECT * FROM usefull_documents";
$result = $conn->query($sql);
$list="";
$general="";
$diplomatic="";
$delete="";
$metaptuxiako="";
$didaktoriko="";
while($doc = $result->fetch_assoc()){
  $list.="<option value=\"".$doc['dir']."\">".$doc['title']."</option>";
  if($doc['category']=="general"){
    $general.="<a href=\"".$doc['dir']."\" download>".$doc['title']."</a><br>";
  }elseif($doc['category']=="diplomatic"){
    $diplomatic.="<a href=\"".$doc['dir']."\" download>".$doc['title']."</a><br>";
  }elseif($doc['category']=="delete"){
    $delete.="<a href=\"".$doc['dir']."\" download>".$doc['title']."</a><br>";
  }elseif($doc['category']=="metaptuxiako"){
    $metaptuxiako.="<a href=\"".$doc['dir']."\" download>".$doc['title']."</a><br>";
  }else{
    $didaktoriko.="<a href=\"".$doc['dir']."\" download>".$doc['title']."</a><br>";
  }
}
$conn->close();

if(isset($_SESSION['secretariat'])){
  $addORdeleteDOC="<form action=\"usefull_documents.php\" method=\"POST\" enctype=\"multipart/form-data\">
     <label><h2>Add document:</h2></label>
     <input type=\"file\" name=\"file\" id=\"file\" >
     <label><h3>Category of the document:</h3></label>
     <select name=\"doc_category\" style=\"font-size=25px\">
       <option value=\"general\">Γενικά έντυπα ετήσεων</option>
       <option value=\"diplomatic\">Έντυπα Διπλωματικών Εργασιών</option>
       <option value=\"delete\">Έντυπα Διαγραφών Φοιτητή</option>
       <option value=\"metaptuxiako\">Έντυπα για Μεταπτυχιακές Σπουδές</option>
       <option value=\"didaktoriko\">Έντυπα για Διδακτορικές Σπουδές</option>
     </select>
    <input type=\"submit\" class=add_new_button value=\"&#9546;Add document\">
  </form>
  <br>
  <form action=\"usefull_documents.php\" method=\"post\">
    <label><h3>Select a document you want to delete:</h3></label>
    <select name=\"delete_doc\" style=\"font-size=25px\">".$list."
    </select>
    <input type=\"submit\" value=\"Delete\">
  </form>";
}
else{
  $addORdeleteDOC="";
}

$content="
<div class=\"col-md-9\">
  <div id=\"content\">
   ".$addORdeleteDOC."
  <br>
    <h1>Χρήσιμα Έντυπα</h1>
    <br>
    <p><strong>Γενικά έντυπα ετήσεων</strong> <br><br>
    ".$general."
    </p>
    <br>
    <p><strong>Έντυπα Διπλωματικών Εργασιών</strong><br><br>
    ".$diplomatic."
    </p>
    <br>
    <p><strong>Έντυπα Διαγραφών Φοιτητή</strong><br><br>
    ".$delete."
    </p>
    <br>
    <p><strong>Έντυπα για Μεταπτυχιακές Σπουδές</strong><br><br>
    ".$metaptuxiako."
    </p>
    <br>
    <p><strong>Έντυπα για Διδακτορικές Σπουδές</strong><br><br>
    ".$didaktoriko."
    </p>
  </div>
</div>
  <div class=\"col-md-3\">
    <div id=\"side_bar\">
  </div>
</div>";
include 'WebPageTemplate.php';
?>
