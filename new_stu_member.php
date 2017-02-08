<?php
    $member="";
    $member.="<div class=\"container\"><form action=\"secretary_members.php\" method=\"POST\" enctype=\"multipart/form-data\"><div class=\"form-group\">";
    $member.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <label><h1>New member edit:</h1></label>
      </div>
    </div>";
    $member.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <label><h1><h3>General information:</h3></h1></label>
      </div>
    </div>";
    $member.="
    <div class=\"row\"><div class=\"col-md-8\">
    <table class=\"table table-bordered table-hover\" id=\"update_table\">
    <tr>
      <td>Secretary ID:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_id\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Password:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_pwd\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>First Name:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_fname\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Last Name:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_lname\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Telephone:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_telephone\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Fax:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_fax\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Email:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_email\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>";
    $member.="</table></div></div>";
    $member.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <label><h3>Add photo:</h3></label>
        <input name=\"file\" type=\"file\" id=\"file\" accept=\".png,.jpg,.bmp\">
      </div>
    </div>";
    $member.="<br><br>
    <div class=\"row\"><div class=\"col-md-8\">
    <h3>If you finished creating press here:</h3>
    <input type=\"submit\" value=\"FINISH\" class=\"add_new_button\">
    </div></div>
    </div></form></div>
    <br><br>";
    $content="<div class=\"col-md-9\"><div id=\"content\">".$member."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
?>
