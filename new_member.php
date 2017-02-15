<?php
    $member="";
    $member.="<div class=\"container\"><form action=\"faculty_show.php\" method=\"POST\" enctype=\"multipart/form-data\"><div class=\"form-group\">";
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
      <td>ProfessorID:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_id\" style=\"height:100%; width:100%;\" required=\"\"></td>
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
      <td>Role:</td><td style=\"padding:0;\">
        <select name=\"new_role\" style=\"height:100%; width:100%;\" required=\"\">
          <option value=\"Καθηγητής\">Καθηγητής</option>
          <option value=\"Αναπληρωτής καθηγητής\">Αναπληρωτής καθηγητής</option>
          <option value=\"Επίκουρος καθηγητής\">Επίκουρος καθηγητής</option>
          <option value=\"Ομότιμος Καθηγητής\">Ομότιμος Καθηγητής</option>
          <option value=\"Επίτιμος Καθηγητής\">Επίτιμος Καθηγητής / Διδάκτορας</option>
          <option value=\"Επιστημονικός Συνεργάτης\">Επιστημονικός Συνεργάτης</option>
          <option value=\"ΕΔΙΠ\">ΕΔΙΠ</option>
          <option value=\"ΕΤΕΠ\">ΕΤΕΠ</option>
          <option value=\"Διοικητικό Προσωπικό\">Διοικητικό Προσωπικό</option>
        </select>
      </td>
    </tr>
    <tr>
      <td>Resume:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_resume\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Sector:</td><td style=\"padding:0;\">
      <select name=\"new_sector\" style=\"height:100%; width:100%;\" required=\"\">
        <option value=\"Τομέας Τηλεπικοινωνιών και Τεχνολογίας Πληροφορίας\">Τομέας Τηλεπικοινωνιών και Τεχνολογίας Πληροφορίας</option>
        <option value=\"Τομέας Συστημάτων Ηλεκτρικής Ενέργειας\">Τομέας Συστημάτων Ηλεκτρικής Ενέργειας</option>
        <option value=\"Τομέας Ηλεκτρονικής και Υπολογιστών\">Τομέας Ηλεκτρονικής και Υπολογιστών</option>
        <option value=\"Τομέας Συστημάτων και Αυτόματου Ελέγχου\">Τομέας Συστημάτων και Αυτόματου Ελέγχου</option>
        <option value=\"ΓΕΝΙΚΟ ΤΜΗΜΑ\">ΓΕΝΙΚΟ ΤΜΗΜΑ</option>
        <option value=\"Άλλο τμήμα\">Άλλο τμήμα</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>Telephone:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_telephone\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Fax:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_fax\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Email:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_email\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Hours for Students:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_hours\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Website:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_website\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Google Scholar:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_google\" style=\"height:100%; width:100%;\" required=\"\"></td>
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
