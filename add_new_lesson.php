<?php
    $lesson="";
    $lesson.="<div class=\"container\"><form action=\"courses.php\" method=\"POST\"><div class=\"form-group\">";
    $lesson.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <label><h1>New lesson edit:</h1></label>
      </div>
    </div>";
    $lesson.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <label><h1><h3>General information:</h3></h1></label>
      </div>
    </div>";
    $lesson.="
    <div class=\"row\"><div class=\"col-md-8\">
    <table class=\"table table-bordered table-hover\" id=\"update_table\">
    <tr>
      <td>Title:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_title\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Lesson Code:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_id\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Level of studies:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_level\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Semester:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_semester\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Description:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_description\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Type:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_type\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Official Website:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_officialwebsite\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Eclass Website:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_eclasslink\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Eudoxus Link:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_eudoxus\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Ects of Lecture:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_Δ\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Ects of A:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_Α\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Ects of Lab:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_Ε\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
    <td>Sector:</td><td style=\"padding:0;\">
        <select name=\"new_sector\" style=\"height:100%; width:100%;\" required=\"\">
          <option value=\"ΒΑΣΙΚΟΣ ΚΟΡΜΟΣ\">ΒΑΣΙΚΟΣ ΚΟΡΜΟΣ</option>
          <option value=\"Telecommunications & Information Technology\">Telecommunications & Information Technology</option>
          <option value=\"Electric Power Systems\">Electric Power Systems</option>
          <option value=\"Electronics & Computers\">Electronics & Computers</option>
          <option value=\"Systems & Automatic Control\">Systems & Automatic Control</option>
          <option value=\"Optional\">Optional</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>System of examination:</td>
      <td style=\"padding:0;\">
        <select name=\"new_exams\" style=\"height:100%; width:100%;\" required=\"\">
          <option value=\"ΓΡΑΠΤΗ\">ΓΡΑΠΤΗ</option>
          <option value=\"ΠΡΟΦΟΡΙΚΗ\">ΠΡΟΦΟΡΙΚΗ</option>
        </select>
      </td>
      </td>
    </tr>
    <tr>
      <td>Teaching hours and place:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_hours\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Recent statistics:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_statistics\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>LabID:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_lab\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Curriculum:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_curriculum\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT StudyScheduleID FROM professor_lessons_thisyear";
    $result = $conn->query($sql);
    while($choice = $result->fetch_assoc()){
      $lesson.="
      <tr>
        <td style=\"visibility:hidden;display:none;\"><input type=\"text\" name=\"schedule\" value=\"".$choice['StudyScheduleID']."\"></td>
      </tr>";
      break;
    }
    $conn->close();
    $lesson.="</table></div></div>";
    $lesson.="<br><br>
    <div class=\"row\"><div class=\"col-md-8\">
    <button type=\"button\" class=\"add_new_button\" onclick=\"new_prof();\">&#9546;ADD NEW PROFESSOR</button><br>
    <button type=\"button\" class=\"add_new_button\" onclick=\"new_rel();\">&#9546;ADD NEW RELATIVE LESSON</button><br>
    <button type=\"button\" class=\"add_new_button\" onclick=\"new_book();\">&#9546;ADD NEW BOOK(ISBN)</button>
    <h3>If you finished creating press here:</h3>
    <input type=\"submit\" value=\"FINISH\" class=\"add_new_button\">
    </div></div>
    </div></form></div>
    <br><br>";
    $content="<div class=\"col-md-9\"><div id=\"content\">".$lesson."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
?>
