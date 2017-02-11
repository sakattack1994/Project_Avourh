<?php
if(!isset($_SESSION))
    {
      session_start();
    }
if(isset($_POST['sec_choose'])){
    $secr="";
    $secr.="<div class=\"container\">";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM secretariat WHERE SecretariatID=\"".$_POST['sec_choose']."\"";
    $result = $conn->query($sql);
    $edit="";
    if($_SESSION['user']==$_POST['sec_choose']){
      $edit="<div class=\"row\">
          <div class=\"col-md-8\">
            <h3>If you want to edit the profile press here:</h3>
            </div>
          </div>
          <div class=\"row\">
          <div class=\"col-md-8\">
            <form action=\"edit_secr.php\" method=\"POST\">
              <button type=\"submit\" name=\"secr_edit\" value=".$_POST['sec_choose']." class=\"add_new_button\">EDIT PROFILE</button>
            </form>
          </div>
        </div>
      ";
    }
    else{
      $edit.="
        <div class=\"row\">
          <div class=\"col-md-8\">
            <h3>If you want to edit the profile press here:</h3>
            </div>
          </div>
          <div class=\"row\">
          <div class=\"col-md-8\">
            <form action=\"edit_secr.php\" method=\"POST\">
              <button type=\"submit\" name=\"secr_edit\" value=".$_POST['sec_choose']." class=\"add_new_button\">EDIT PROFILE</button>
            </form>
          </div>
        </div>
        <div class=\"row\">
          <div class=\"col-md-8\">
            <h3>If you want to delete this secretary member press here:</h3>
          </div>
        </div>
        <div class=\"row\">
          <div class=\"col-md-8\">
            <form action=\"secretary_members.php\" method=\"POST\">
              <button type=\"submit\" name=\"sec_delete\" value=".$_POST['sec_choose']." class=\"add_new_button\">DELETE MEMBER</button>
            </form>
          </div>
        </div>";
    }
    while($choice = $result->fetch_assoc()){
      $secr.=
      $edit."
      <div class=\"row\">
          <div class=\"col-md-8\"><h1>".$choice['LastName']." ".$choice['FirstName']."</h1></div>
      </div><br><br>
      <div class=\"row\">
          <div class=\"col-md-2\"><img src=\"".$choice['Photo']."\" width=\"180px\" height=\"190px\"></div>
          <div class=\"col-md-6\">
            <h3>".$choice['LastName']." ".$choice['FirstName']."</h3>
            <p>Telephone: ".$choice['Telephone']."</p>
            <p>Fax: ".$choice['Fax']."</p>
            <p>Email: ".$choice['Email']."</p>
          </div>
      </div>
      <br><br>
      ";
    }
    $conn->close();
    $secr.="</div>";
    $content="<div class=\"col-md-9\"><div id=\"content\">".$secr."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
