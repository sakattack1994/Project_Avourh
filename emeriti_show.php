<?php
if(!isset($_SESSION))
    {
      session_start();
    }
$conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
$sql='SET NAMES utf8';
$result = $conn->query($sql);
$table="<table class=\"table table-bordered table-hover\">";
$table.="<form action=\"professor_show.php\" method=\"POST\">";
$sql = "SELECT * FROM professors WHERE Role=\"Ομότιμος Καθηγητής\"";
$result = $conn->query($sql);
$i=0;
while($prof = $result->fetch_assoc()){
  if($i==0){
    $table.="<tr>";
  }
  $table.="<td align=\"center\"><button type=\"submit\" name=\"prof_choose\" value=".$prof['ProfessorID']."><font size=\"3px\"><img src=\"".$prof['Photo']."\" width=\"140px\" height=\"150px\">
  <br>".$prof['LastName']." ".$prof['FirstName']."</font></button><br>
  ".$prof['Role']."<br>
  ".$prof['Sector']."
  </td>";
  $i=$i+1;
  if($i==4){
    $table.="</tr>";
    $i=0;
  }
}
$conn->close();
$table.="</form></table>";
if(isset($_SESSION['secretariat'])){
  $edit="<h3>If you want to add a new professor press here:</h3>
  <form action=\"new_member.php\" method=\"POST\">
    <button type=\"submit\" name=\"member_add\" class=\"add_new_button\">ADD NEW PERSONEL MEMBER</button>
  </form>
  <br>";
}
else{
  $edit="";
}
$content="
<div class=\"col-md-9\">
  <div id=\"content\">
    <h1>Emeriti Professors</h1><br>
".$edit."
    ".$table."
    </div>
</div>
  <div class=\"col-md-3\">
    <div id=\"side_bar\">
  </div>
</div>";
include 'WebPageTemplate.php';
?>
