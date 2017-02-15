<?php
if(!isset($_SESSION))
    {
      session_start();
    }
if(isset($_POST['student_edit'])){
    $stu="";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM students WHERE StudentID=\"".$_POST['student_edit']."\"";
    $result = $conn->query($sql);
    $edit="";
    while($choice = $result->fetch_assoc()){
      $sql = "SELECT * FROM members WHERE ID=\"".$_POST['student_edit']."\"";
      $result2 = $conn->query($sql);
      while($choice2 = $result2->fetch_assoc()){
        if(isset($_SESSION['secretariat']))
        {
          if($_SESSION['secretariat']==1){
            $selected = array(" ", " ", " "," ", " ", " "," ", " ", " "," ");
            $selected[$choice['Semester']-1]="selected";
            $edit.="
            <tr>
              <td>Level Of Studies:</td><td style=\"padding:0;\">
              <select name=\"s_level\" style=\"height:100%; width:100%;\" required=\"\">
                <option value=\"-1\">Pregraduate</option>
                <option value=\"1\">Postgraduate</option>
                <option value=\"0\">Doctora</option>
              </select>
              </td>
            </tr>
            <tr>
              <td>Semester:</td>
              <td style=\"padding:0;\">
                <select name=\"s_semester\" style=\"height:100%; width:100%;\" required=\"\">
                  <option value=\"1\" ".$selected[0].">1</option>
                  <option value=\"2\" ".$selected[1].">2</option>
                  <option value=\"3\" ".$selected[2].">3</option>
                  <option value=\"4\" ".$selected[3].">4</option>
                  <option value=\"5\" ".$selected[4].">5</option>
                  <option value=\"6\" ".$selected[5].">6</option>
                  <option value=\"7\" ".$selected[6].">7</option>
                  <option value=\"8\" ".$selected[7].">8</option>
                  <option value=\"9\" ".$selected[8].">9</option>
                  <option value=\"10\" ".$selected[9].">10</option>
                </select>
              </td>
            </tr>
            <tr>
              <td>Student ID:</td><td style=\"padding:0;\"><input type=\"text\" name=\"s_id\" value=\"".$choice['StudentID']."\" style=\"height:100%; width:100%;\"></td>
            </tr>
            ";
          }
        }
      $stu.="<div class=\"container\"><form action=\"all_students.php\" method=\"POST\" enctype=\"multipart/form-data\"><div class=\"form-group\">";
      $stu.="
      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h1>".$choice['LastName']." ".$choice['FirstName']."</h1></label>
        </div>
      </div>";
      $stu.="
      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h1><h3>General information:</h3></h1></label>
        </div>
      </div>";
      $stu.="
      <div class=\"row\"><div class=\"col-md-8\">
      <table class=\"table table-bordered table-hover\" id=\"update_table\">
      <tr>
        <td style=\"visibility:hidden;display:none;\"><input type=\"text\" name=\"old_code\" value=\"".$choice['StudentID']."\"></td>
      </tr>
      <tr>
        <td>Picture:</td>
        <td style=\"padding:0;\">
          <img src=\"".$choice['Photo']."\" width=\"180px\" height=\"190px\">
          <label><h3>Change photo:</h3></label>
          <input name=\"file\" type=\"file\" id=\"file\">
        </td>
      </tr>
      ".$edit."
      <tr>
        <td>Password:</td><td style=\"padding:0;\"><input type=\"text\" name=\"s_pwd\" value=\"".$choice2['Password']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Last Name:</td><td style=\"padding:0;\"><input type=\"text\" name=\"s_lname\" value=\"".$choice['LastName']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>First Name:</td><td style=\"padding:0;\"><input type=\"text\" name=\"s_fname\" value=\"".$choice['FirstName']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Telephone:</td><td style=\"padding:0;\"><input type=\"text\" name=\"s_telephone\" value=\"".$choice['Telephone']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Address:</td><td style=\"padding:0;\"><input type=\"text\" name=\"s_addr\" value=\"".$choice['Address']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Email:</td><td style=\"padding:0;\"><input type=\"text\" name=\"s_email\" value=\"".$choice['Email']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      ";
      $stu.="</table></div></div>";
      }
    }
    $stu.="<br><br>
    <div class=\"row\"><div class=\"col-md-8\">
    <h3>If you finished editing press here:</h3>
    <input type=\"submit\" value=\"FINISH\" class=\"add_new_button\">
    </div></div>
    </div></form></div>
    <br><br>";
    $conn->close();
    $content="<div class=\"col-md-9\"><div id=\"content\">".$stu."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
