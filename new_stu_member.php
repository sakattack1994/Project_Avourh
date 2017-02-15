<?php
    $member="";
    $member.="<div class=\"container\"><form action=\"all_students.php\" method=\"POST\" enctype=\"multipart/form-data\"><div class=\"form-group\">";
    $member.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <label><h1>New student edit:</h1></label>
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
      <td>Student ID:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_id\" style=\"height:100%; width:100%;\" required=\"\"></td>
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
      <td>Address:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_addr\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Email:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_email\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Level Of Studies:</td><td style=\"padding:0;\">
      <select name=\"new_level\" style=\"height:100%; width:100%;\" required=\"\">
        <option value=\"-1\">Pregraduate</option>
        <option value=\"1\">Postgraduate</option>
        <option value=\"0\">Doctora</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Semester:</td>
      <td style=\"padding:0;\">
        <select name=\"new_semester\" style=\"height:100%; width:100%;\" required=\"\">
          <option value=\"1\">1</option>
          <option value=\"2\">2</option>
          <option value=\"3\">3</option>
          <option value=\"4\">4</option>
          <option value=\"5\">5</option>
          <option value=\"6\">6</option>
          <option value=\"7\">7</option>
          <option value=\"8\">8</option>
          <option value=\"9\">9</option>
          <option value=\"10\">10</option>
        </select>
      </td>
    </tr>
    ";
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
