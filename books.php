<?php
$alert="";
if(isset($_POST['new_isbn'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $cover="";
  if($_FILES["file"]["name"]){
    move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/books_cover/'.$_FILES['file']['name']);
    $cover="/myDepartment/myresources/books_cover/".$_FILES['file']['name'];
  }
  else{
    $cover="/myDepartment/myresources/books_cover/default.png";
  }
  $sql="INSERT INTO books VALUES
  (\"".$_POST['new_isbn']."\",
  \"".$_POST['new_title']."\",
  \"".$_POST['new_author']."\",
  \"".$_POST['new_yearofpubl']."\",
  \"".$_POST['new_publno']."\",
  \"".$_POST['new_publisher']."\",
  \"".$_POST['new_description']."\",
  \"".$cover."\")";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The book ".$_POST['new_isbn']." ".$_POST['new_title']." was successfully added.</strong></div>";
}

if(isset($_POST['book_delete'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $sql="SELECT Cover FROM books WHERE ISBN=\"".$_POST['book_delete']."\"";
  $result = $conn->query($sql);
  while($choice = $result->fetch_assoc()){
    if($choice['Cover']!="/myDepartment/myresources/books_cover/default.png"){
      unlink($_SERVER['DOCUMENT_ROOT'].$choice['Cover']);
    }
  }
  $sql="DELETE FROM books WHERE ISBN=\"".$_POST['book_delete']."\"";
  $result = $conn->query($sql);
  $sql="DELETE FROM lesson_book WHERE ISBN=\"".$_POST['book_delete']."\"";
  $result = $conn->query($sql);

  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The book was successfully deleted.</strong></div>";
}

if(isset($_POST['p_isbn'])){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=0';
  $result = $conn->query($sql);
  $sql="UPDATE books
  SET ISBN=\"".$_POST['p_isbn']."\",
  Title=\"".$_POST['p_title']."\",
  Author=\"".$_POST['p_author']."\",
  YearΟfPublishing=\"".$_POST['p_yearofpubl']."\",
  PublicationNumber=\"".$_POST['p_publno']."\",
  Publisher=\"".$_POST['p_publisher']."\",
  Description=\"".$_POST['p_description']."\"
  WHERE ISBN=\"".$_POST['old_isbn']."\"
  ";
  $result = $conn->query($sql);
  $cover="";
  if($_FILES["file"]["name"]){
    move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/books_cover/'.$_FILES['file']['name']);
    $cover="/myDepartment/myresources/books_cover/".$_FILES['file']['name'];
    $sql="UPDATE books
    SET Cover=\"".$cover."\"
    WHERE ISBN=\"".$_POST['p_isbn']."\"
    ";
    $result = $conn->query($sql);
  }
  $sql="UPDATE lesson_book SET ISBN=\"".$_POST['p_isbn']."\" WHERE ISBN=\"".$_POST['old_isbn']."\"";
  $result = $conn->query($sql);
  $sql='SET FOREIGN_KEY_CHECKS=1';
  $result = $conn->query($sql);
  $conn->close();
  $alert="<div class=\"alert alert-success\"><strong>The book ".$_POST['p_isbn']." ".$_POST['p_title']." was successfully updated.</strong></div>";
}


$conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
$sql='SET NAMES utf8';
$result = $conn->query($sql);
$table="<table class=\"table table-bordered table-hover\">";
$table.="<form action=\"book_show.php\" method=\"POST\">";
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
$i=0;
while($book = $result->fetch_assoc()){
  if($i==0){
    $table.="<tr>";
  }
  $table.="<td align=\"center\"><button type=\"submit\" name=\"book_choose\" value=".$book['ISBN']."><font size=\"3px\"><img src=\"".$book['Cover']."\" width=\"140px\" height=\"150px\">
  <br>".$book['Title']."</font></button></td>";
  $i=$i+1;
  if($i==4){
    $table.="</tr>";
    $i=0;
  }
}
$conn->close();
$table.="</form></table>";
$content="
<div class=\"col-md-9\">
  <div id=\"content\">
    <h1>Books</h1><br>
    ".$alert."
    <h3>If you want to add a new book press here:</h3>
    <form action=\"new_book.php\" method=\"POST\">
      <button type=\"submit\" name=\"book_add\" class=\"add_new_button\">ADD NEW BOOK</button>
    </form>
    <br> <br> <br>
    ".$table."
    </div>
</div>
  <div class=\"col-md-3\">
    <div id=\"side_bar\">
  </div>
</div>";
include 'WebPageTemplate.php';
?>
