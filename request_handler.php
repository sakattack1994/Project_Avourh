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
  $file="";
  $name1="";
  $menu="";
  if(isset($_SESSION['prof']))
  {
    if($_SESSION['prof']==1){
      $file="professor_show.php";
      $name1="prof_choose";
      $menu.="
      <a href=\"welcome_login.php\"><li tabindex=\"0\" ><font style=\"color:rgba(0, 0, 0, 0.6);font-size:15px\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-home\" style=\"align:left;color:white;\"></span></span> Home</font></li></a>
      <a href=\"prof_my_lessons.php\"><li tabindex=\"0\" ><font style=\"color:rgba(0, 0, 0, 0.6);font-size:15px\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-plus-sign\" style=\"align:left;color:white;\"></span></span> My lessons</font></li></a>
      <a href=\"my_statistics.php\"><li tabindex=\"0\" ><font style=\"color:rgba(0, 0, 0, 0.6);font-size:15px\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-plus-sign\" style=\"align:left;color:white;\"></span></span> My statistics</font></li></a>
      ";
    }
  }
  if(isset($_SESSION['secretariat']))
  {
    if($_SESSION['secretariat']==1){
      $file="secretary_show.php";
      $name1="sec_choose";
      $menu.="
      <a href=\"welcome_login.php\"><li tabindex=\"0\" ><font style=\"color:rgba(0, 0, 0, 0.6);font-size:15px\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-home\" style=\"align:left;color:white;\"></span></span> Home</font></li></a>
      <a href=\"add_announcement.php\"><li tabindex=\"0\" ><font style=\"color:rgba(0, 0, 0, 0.6);font-size:15px\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-blackboard\" style=\"align:left;color:white;\"></span></span> Add Announcement</font></li></a>
      <a href=\"new_member.php\"><li tabindex=\"0\" ><font style=\"color:rgba(0, 0, 0, 0.6);font-size:15px\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-user\" style=\"align:left;color:white;\"></span></span> Add Personnel Member</font></li></a>
      <a href=\"secretary_members.php\"><li tabindex=\"0\" ><font style=\"color:rgba(0, 0, 0, 0.6);font-size:15px\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-phone-alt\" style=\"align:left;color:white;\"></span></span> Secretariat management</font></li></a>
      <a href=\"all_students.php\"><li tabindex=\"0\" ><font style=\"color:rgba(0, 0, 0, 0.6);font-size:15px\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-education\" style=\"align:left;color:white;\"></span></span> Students management</font></li></a>
      <a href=\"add_study_schedule.php\"><li tabindex=\"0\" ><font style=\"color:rgba(0, 0, 0, 0.6);font-size:15px\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-plus-sign\" style=\"align:left;color:white;\"></span></span> Add New study guide</font></li></a>
      <a href=\"add_new_lesson.php\"><li tabindex=\"0\" ><font style=\"color:rgba(0, 0, 0, 0.6);font-size:15px\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-text-background\" style=\"align:left;color:white;\"></span></span> Add New Lesson</font></li></a>
      <a href=\"new_book.php\"><li tabindex=\"0\" ><font style=\"color:rgba(0, 0, 0, 0.6);font-size:15px\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-book\" style=\"align:left;color:white;\"></span></span> Add New Book</font></li></a>
      ";
    }
  }
  if(isset($_SESSION['student']))
  {
    if($_SESSION['student']==1){
      $file="student_profile.php";
      $name1="stu_choose";
    }
  }

  $html="
  <nav class=\"usermenu\" tabindex=\"0\">
  <form action=\"".$file."\" method=\"POST\" class=\"avatar\">
  <button type=\"submit\" class=\"avatar\" style=\"border-radius:50%;\" name=\"".$name1."\" value=\"".$_SESSION['user']."\">
		<img src=\"".$photo."\" title=\"My profile\"/>
  </button>
  <h2>".$name."</h2>
	<ul>
    ".$menu."
    <a href=\"logout.php\"><li tabindex=\"0\"><font style=\"color:rgba(0, 0, 0, 0.6)\"><span class=\"pull-left\"><span class=\"glyphicon glyphicon-log-out\" style=\"align:left;color:white;\"></span></span>Logout</font></li></a>
  </ul>
  </form>
</nav>";
echo $html;
}

if(isset($_GET['announcement_id'])){
  $announcement_id=$_GET['announcement_id'];
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
