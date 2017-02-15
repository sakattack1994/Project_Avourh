<?php
if(!isset($_SESSION))
    {
      session_start();
    }
if(isset($_POST['publication_id'])){
    $publ="";
    $publ.="<div class=\"container\">";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM scientificpublications WHERE PublicationID=\"".$_POST['publication_id']."\"";
    $result = $conn->query($sql);
    $edit="";
    $sql = "SELECT * FROM professors_publications WHERE PublicationID=\"".$_POST['publication_id']."\"";
    $result2 = $conn->query($sql);
    while($choice2 = $result2->fetch_assoc()){
      if(isset($_SESSION['user'])){
        if($_SESSION['user']==$choice2['ProfessorID']){
          $edit="<div class=\"row\">
            <div class=\"col-md-8\">
              <h3>If you want to edit the publication press here:</h3>
              </div>
            </div>
            <div class=\"row\">
              <div class=\"col-md-8\">
                <form action=\"edit_publication.php\" method=\"POST\">
                  <button type=\"submit\" name=\"publication_edit\" value=".$_POST['publication_id']." class=\"add_new_button\">EDIT PUBLICATION</button>
                </form>
              </div>
            </div>
          ";
          $edit.="
            <div class=\"row\">
              <div class=\"col-md-8\">
                <h3>If you want to delete this publication press here:</h3>
              </div>
            </div>
            <div class=\"row\">
              <div class=\"col-md-8\">
                <form action=\"my_publications.php\" method=\"POST\">
                  <button type=\"submit\" name=\"pub_delete\" value=".$_POST['publication_id']." class=\"add_new_button\">DELETE PUBLICATION</button>
                </form>
              </div>
            </div>";
        }
      }
    }
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
        <td>Publication title:</td><td>".$choice['Title']."</td>
      </tr>
      <tr>
        <td>Year of Publish:</td><td>".$choice['YearOfPublish']."</td>
      </tr>
      <tr>
        <td>Description:</td><td>".$choice['Description']."</td>
      </tr>
      </tbody>
      </table></div>
      ".$edit."
      <br><br>
      ";
    }
    $conn->close();
    $publ.="</div>";
    $content="<div class=\"col-md-9\"><div id=\"content\">".$publ."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
