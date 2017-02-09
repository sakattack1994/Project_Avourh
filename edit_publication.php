<?php
if(!isset($_SESSION))
    {
      session_start();
    }
if(isset($_POST['publication_edit'])){
    $publ="";
    $publ.="<div class=\"container\"><form action=\"my_publications.php\" method=\"POST\"><div class=\"form-group\">";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM scientificpublications WHERE PublicationID=\"".$_POST['publication_edit']."\"";
    $result = $conn->query($sql);
    while($choice = $result->fetch_assoc()){
      $publ.="
        <div class=\"row\">
          <div class=\"col-md-8\">
            <h1>".$choice['Title']."</h1>
          </div>
        </div>
      </div><br><br>
      <div class=\"row\">
        <div class=\"col-md-8\">
      <table class=\"table table-bordered table-hover\">
      <thead>
        <tr style=\"background-color:rgb(41,127,184);\";>
          <th colspan=8 style=\"text-align: center;\"><font color=\"#fff\">General Information</font></th>
          </tr>
      </thead>
      <tbody>
      <tr>
        <td style=\"visibility:hidden;display:none;\"><input type=\"text\" name=\"pub_id\" value=\"".$choice['PublicationID']."\"></td>
      </tr>
      <tr>
        <td>Publication title:</td><td><input type=\"text\" name=\"edit_title\" value=\"".$choice['Title']."\" style=\"height:100%; width:100%;\" required=\"\"></td>
      </tr>
      <tr>
        <td>Year of Publish:</td><td><input type=\"date\" name=\"edit_date\" value=\"".$choice['YearOfPublish']."\" style=\"height:100%; width:100%;\" required=\"\"></td>
      </tr>
      <tr>
        <td>Description:</td><td><textarea name=\"edit_description\" rows=\"10\" cols=\"40\" style=\"height:100%; width:100%;\" required=\"\">".$choice['Description']."</textarea></td>
      </tr>
      </tbody>
      </table></div>
      <br><br>
      <div class=\"row\"><div class=\"col-md-8\">
      <h3>If you finished editing press here:</h3>
      <input type=\"submit\" value=\"FINISH\" class=\"add_new_button\">
      </div></div>
      ";
    }
    $conn->close();
    $publ.="</div></form></div>";
    $content="<div class=\"col-md-9\"><div id=\"content\">".$publ."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
