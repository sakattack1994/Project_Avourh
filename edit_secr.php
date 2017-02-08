<?php
if(isset($_POST['secr_edit'])){
    $secr="";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM secretariat WHERE SecretariatID=\"".$_POST['secr_edit']."\"";
    $result = $conn->query($sql);
    while($choice = $result->fetch_assoc()){
      $sql = "SELECT * FROM members WHERE ID=\"".$_POST['secr_edit']."\"";
      $result2 = $conn->query($sql);
      while($choice2 = $result2->fetch_assoc()){
      $secr.="<div class=\"container\"><form action=\"secretary_members.php\" method=\"POST\" enctype=\"multipart/form-data\"><div class=\"form-group\">";
      $secr.="
      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h1>".$choice['LastName']." ".$choice['FirstName']."</h1></label>
        </div>
      </div>";
      $secr.="
      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h1><h3>General information:</h3></h1></label>
        </div>
      </div>";
      $secr.="
      <div class=\"row\"><div class=\"col-md-8\">
      <table class=\"table table-bordered table-hover\" id=\"update_table\">
      <tr>
        <td style=\"visibility:hidden;display:none;\"><input type=\"text\" name=\"old_code\" value=\"".$choice['SecretariatID']."\"></td>
      </tr>
      <tr>
        <td>Picture:</td>
        <td style=\"padding:0;\">
          <img src=\"".$choice['Photo']."\" width=\"180px\" height=\"190px\">
          <label><h3>Change photo:</h3></label>
          <input name=\"file\" type=\"file\" id=\"file\">
        </td>
      </tr>
      <tr>
        <td>Secretary ID:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_id\" value=\"".$choice['SecretariatID']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Password:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_pwd\" value=\"".$choice2['Password']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Last Name:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_lname\" value=\"".$choice['LastName']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>First Name:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_fname\" value=\"".$choice['FirstName']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Telephone:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_telephone\" value=\"".$choice['Telephone']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Fax:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_fax\" value=\"".$choice['Fax']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Email:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_email\" value=\"".$choice['Email']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      ";
      $secr.="</table></div></div>";
      }
    }
    $secr.="<br><br>
    <div class=\"row\"><div class=\"col-md-8\">
    <h3>If you finished editing press here:</h3>
    <input type=\"submit\" value=\"FINISH\" class=\"add_new_button\">
    </div></div>
    </div></form></div>
    <br><br>";
    $conn->close();
    $content="<div class=\"col-md-9\"><div id=\"content\">".$secr."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
