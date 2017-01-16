<?php
if(isset($_POST['userID'])){
  if(!isset($_SESSION))
      {
        session_start();
      }
  $html="";
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql = "SELECT * FROM members WHERE ID=\"".$_SESSION['user']."\"";
  $result = $conn->query($sql);
  while($member = $result->fetch_assoc()){
    if($member['Role']=='prof'){
      $sql = "SELECT * FROM professors WHERE ProfessorID=\"".$_SESSION['user']."\"";
      $result1 = $conn->query($sql);
      while($prof = $result1->fetch_assoc()){
        $name=$prof['LastName']." ".$prof['FirstName'];
        $photo=$prof['Photo'];
      }
    }
    else if($member['Role']=='student'){
      $sql = "SELECT * FROM students WHERE StudentID=\"".$_SESSION['user']."\"";
      $result2 = $conn->query($sql);
      while($student = $result2->fetch_assoc()){
        $name=$student['LastName']." ".$student['FirstName'];
        $photo=$student['Photo'];
      }
    }
    else if($member['Role']=='secretariat'){
      $sql = "SELECT * FROM secretariat WHERE SecretariatID=\"".$_SESSION['user']."\"";
      $result3 = $conn->query($sql);
      while($secretariat = $result3->fetch_assoc()){
        $name=$secretariat['LastName']." ".$secretariat['FirstName'];
        $photo=$secretariat['Photo'];
      }
    }
  }
  $conn->close();
  $html="
  <nav class=\"usermenu\" tabindex=\"0\">
  <header class=\"avatar\">
		<img src=\"".$photo."\" />
    <h2>".$name."</h2>
  </header>
	<ul>
    <li tabindex=\"0\" class=\"icon-dashboard\"><span>Dashboard</span></li>
    <li tabindex=\"0\" class=\"icon-customers\"><span>Customers</span></li>
    <li tabindex=\"0\" class=\"icon-users\"><span>Users</span></li>
    <li tabindex=\"0\" class=\"icon-settings\"><span>Settings</span></li>
  </ul>
  <div class=\"logout\"><a href=\"logout.php\">Logout</a></div>
</nav>";
echo $html;
}

if(isset($_POST['announcement_id'])){
  $announcement_id=$_POST['announcement_id'];
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql = "SELECT Header, Content FROM announcements WHERE ID=\"".$announcement_id."\"";
  $result = $conn->query($sql);
  $announcement = $result->fetch_assoc();
  $html="<h1>".$announcement['Header']."</h1><p>".$announcement['Content']."</p>";
  $sql = "SELECT dir FROM attachments WHERE ID=\"".$announcement_id."\"";
  $result = $conn->query($sql);
  $f=0;
  while($att = $result->fetch_assoc()){
    if($f==0){
      $html.="<h2>Attachments:</h2>";
      $f=1;
    }
    $html.="<a href=\"".$att['dir']."\" download>".basename($att['dir'])."</a><br>";
  }
  $html.="<br>";
  $conn->close();
  echo $html;
}
?>
