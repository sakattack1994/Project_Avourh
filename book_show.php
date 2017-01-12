<?php

if(isset($_POST['book_choose'])){
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM books WHERE ISBN=\"".$_POST['book_choose']."\"";
    $result = $conn->query($sql);
    $book = $result->fetch_assoc();
    $conn->close();
}
$content="
<div class=\"col-md-9\">
  <div id=\"content\">
    <div class=\"container\">
      <div class=\"row\">
        <div class=\"col-md-8\"><h1>".$book['Title']."</h1></div>
      </div><br><br>
      <div class=\"row\">
        <div class=\"col-md-2\"><img src=\"".$book['Cover']."\" width=\"180px\" height=\"190px\"></div>
        <div class=\"col-md-6\">
          <p>ISBN: ".$book['ISBN']."</p>
          <p>Συγγραφείς: ".$book['Author']." home page</a></p>
          <p>Έτος έκδοσης: ".$book['YearΟfPublishing']."</p>
          <p>Αριθμός έκδοσης: ".$book['PublicationNumber']."</p>
          <p>Εκδοτικός οίκος: ".$book['Publisher']."</p>
          <p>Περιγραφή: ".$book['Description']."</p>
        </div>
      </div>
  </div>
  </div>
</div>
  <div class=\"col-md-3\">
    <div id=\"side_bar\">
  </div>
</div>";
include 'WebPageTemplate.php';
?>
