<?php
if(isset($_POST['professor_edit'])){
    $prof="";
    $conn = new mysqli('localhost', 'root', '', 'mydepartment');
      // Check connection
    if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      }
    $sql='SET NAMES utf8';
    $result = $conn->query($sql);
    $sql = "SELECT * FROM professors WHERE ProfessorID=\"".$_POST['professor_edit']."\"";
    $result = $conn->query($sql);
    while($choice = $result->fetch_assoc()){
      $selected = array("Καθηγητής"=>" ", "Αναπληρωτής καθηγητής"=>" ", "Επίκουρος καθηγητής"=>" ", "Ομότιμος Καθηγητής"=>" ", "Επίτιμος Καθηγητής"=>" ", "Επιστημονικός Συνεργάτης"=>" ", "ΕΔΙΠ"=>" ", "ΕΤΕΠ"=>" ", "Διοικητικό Προσωπικό"=>" ");
      $selected["".$choice['Role'].""]="selected";
      $selected1 = array("Τομέας Τηλεπικοινωνιών και Τεχνολογίας Πληροφορίας"=>" ", "Τομέας Συστημάτων Ηλεκτρικής Ενέργειας"=>" ", "Τομέας Ηλεκτρονικής και Υπολογιστών"=>" ", "Τομέας Συστημάτων και Αυτόματου Ελέγχου"=>" ", "ΓΕΝΙΚΟ ΤΜΗΜΑ"=>" ", "Άλλο τμήμα"=>" ");
      $selected1["".$choice['Sector'].""]="selected";
      $sql = "SELECT * FROM members WHERE ID=\"".$_POST['professor_edit']."\"";
      $result2 = $conn->query($sql);
      while($choice2 = $result2->fetch_assoc()){
      $prof.="<div class=\"container\"><form action=\"faculty_show.php\" method=\"POST\" enctype=\"multipart/form-data\"><div class=\"form-group\">";
      $prof.="
      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h1>".$choice['LastName']." ".$choice['FirstName']."</h1></label>
        </div>
      </div>";
      $prof.="
      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h1><h3>General information:</h3></h1></label>
        </div>
      </div>";
      $prof.="
      <div class=\"row\"><div class=\"col-md-8\">
      <table class=\"table table-bordered table-hover\" id=\"update_table\">
      <tr>
        <td style=\"visibility:hidden;display:none;\"><input type=\"text\" name=\"old_code\" value=\"".$choice['ProfessorID']."\"></td>
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
        <td>Professor ID:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_id\" value=\"".$choice['ProfessorID']."\" style=\"height:100%; width:100%;\"></td>
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
        <td>Role:</td><td style=\"padding:0;\">
        <select name=\"p_role\" style=\"height:100%; width:100%;\" required=\"\">
          <option value=\"Καθηγητής\" ".$selected['Καθηγητής'].">Καθηγητής</option>
          <option value=\"Αναπληρωτής καθηγητής\" ".$selected['Αναπληρωτής καθηγητής'].">Αναπληρωτής καθηγητής</option>
          <option value=\"Επίκουρος καθηγητής\" ".$selected['Επίκουρος καθηγητής'].">Επίκουρος καθηγητής</option>
          <option value=\"Ομότιμος Καθηγητής\" ".$selected['Ομότιμος Καθηγητής'].">Ομότιμος Καθηγητής</option>
          <option value=\"Επίτιμος Καθηγητής\" ".$selected['Επίτιμος Καθηγητής'].">Επίτιμος Καθηγητής / Διδάκτορας</option>
          <option value=\"Επιστημονικός Συνεργάτης\" ".$selected['Επιστημονικός Συνεργάτης'].">Επιστημονικός Συνεργάτης</option>
          <option value=\"ΕΔΙΠ\" ".$selected['ΕΔΙΠ'].">ΕΔΙΠ</option>
          <option value=\"ΕΤΕΠ\" ".$selected['ΕΤΕΠ'].">ΕΤΕΠ</option>
          <option value=\"Διοικητικό Προσωπικό\" ".$selected['Διοικητικό Προσωπικό'].">Διοικητικό Προσωπικό</option>
        </select>
        </td>
      </tr>
      <tr>
        <td>Resume:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_resume\" value=\"".$choice['Resume']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Sector:</td><td style=\"padding:0;\">
          <select name=\"p_sector\" style=\"height:100%; width:100%;\" required=\"\">
            <option value=\"Τομέας Τηλεπικοινωνιών και Τεχνολογίας Πληροφορίας\" ".$selected1["Τομέας Τηλεπικοινωνιών και Τεχνολογίας Πληροφορίας"].">Τομέας Τηλεπικοινωνιών και Τεχνολογίας Πληροφορίας</option>
            <option value=\"Τομέας Συστημάτων Ηλεκτρικής Ενέργειας\" ".$selected1["Τομέας Συστημάτων Ηλεκτρικής Ενέργειας"].">Τομέας Συστημάτων Ηλεκτρικής Ενέργειας</option>
            <option value=\"Τομέας Ηλεκτρονικής και Υπολογιστών\" ".$selected1["Τομέας Ηλεκτρονικής και Υπολογιστών"].">Τομέας Ηλεκτρονικής και Υπολογιστών</option>
            <option value=\"Τομέας Συστημάτων και Αυτόματου Ελέγχου\" ".$selected1["Τομέας Συστημάτων και Αυτόματου Ελέγχου"].">Τομέας Συστημάτων και Αυτόματου Ελέγχου</option>
            <option value=\"ΓΕΝΙΚΟ ΤΜΗΜΑ\" ".$selected1["ΓΕΝΙΚΟ ΤΜΗΜΑ"].">ΓΕΝΙΚΟ ΤΜΗΜΑ</option>
            <option value=\"Άλλο τμήμα\" ".$selected1["Άλλο τμήμα"].">Άλλο τμήμα</option>
          </select>
        </td>
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
      <tr>
        <td>Ηours For Students:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_hours\" value=\"".$choice['ΗoursForStudents']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Website:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_website\" value=\"".$choice['Website']."\" style=\"height:100%; width:100%;\"></td>
      </tr>
      <tr>
        <td>Google Scholar:</td><td style=\"padding:0;\"><input type=\"text\" name=\"p_google\" value=\"".$choice['GoogleScholar']."\" style=\"height:100%; width:100%;\"></td>
      </tr>";
      $prof.="</table></div></div>";
      }
    }
    $prof.="<br><br>
    <div class=\"row\"><div class=\"col-md-8\">
    <h3>If you finished editing press here:</h3>
    <input type=\"submit\" value=\"FINISH\" class=\"add_new_button\">
    </div></div>
    </div></form></div>
    <br><br>";
    $conn->close();
    $content="<div class=\"col-md-9\"><div id=\"content\">".$prof."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
}
?>
