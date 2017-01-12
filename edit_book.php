<?php
if(isset($_POST['book_edit'])){
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM books WHERE ISBN=\"".$_POST['book_edit']."\"";
    $result = $conn->query($sql);
    $res = $result->fetch_assoc();
    $book="";
    $book.="<div class=\"container\"><form action=\"books.php\" method=\"POST\" enctype=\"multipart/form-data\"><div class=\"form-group\">";
    $book.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <label><h1>".$res['Title']."</h1></label>
      </div>
    </div>
    <div class=\"row\"><div class=\"col-md-8\">
    <table class=\"table table-bordered table-hover\" id=\"update_table\">
    <tr>
      <td style=\"visibility:hidden;display:none;\"><input type=\"text\" name=\"old_isbn\" value=\"".$res['ISBN']."\"></td>
    </tr>
    <tr>
      <td>Cover:</td>
      <td style=\"padding:0;\">
        <img src=\"".$res['Cover']."\" width=\"180px\" height=\"190px\">
        <label><h3>Change cover:</h3></label>
        <input name=\"file\" type=\"file\" id=\"file\">
      </td>
    </tr>
    <tr>
      <td>ISBN:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_isbn\" value=\"".$res['ISBN']."\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Τίτλος:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_title\" value=\"".$res['Title']."\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Συγγραφείς:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_author\" value=\"".$res['Author']."\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Έτος έκδοσης:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_yearofpubl\" value=\"".$res['YearΟfPublishing']."\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Αριθμός έκδοσης:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_publno\" value=\"".$res['PublicationNumber']."\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Εκδοτικός οίκος:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_publisher\" value=\"".$res['Publisher']."\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Περιγραφή:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_description\" value=\"".$res['Description']."\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    </table></div></div>";
    $conn->close();
}

$book.="<br><br>
<div class=\"row\"><div class=\"col-md-8\">
<h3>If you finished editing press here:</h3>
<input type=\"submit\" value=\"FINISH\" class=\"add_new_button\">
</div></div>
</div></form></div>
<br><br>";
$content="<div class=\"col-md-9\"><div id=\"content\">".$book."
</div></div>
<div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
include 'WebPageTemplate.php';
?>
