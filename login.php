<?php
  session_start();
  $username="";
  $password="";
  $username=$_POST['username'];
  $password=$_POST['password'];

  //check for sql injection
  $username=stripcslashes($username);
  $password=stripcslashes($password);
  $username=mysql_real_escape_string($username);
  $password=mysql_real_escape_string($password);
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
    // Check connection
  if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $sql="SELECT * FROM members WHERE ID=\"".$username."\"";
  $result = $conn->query($sql);
  if($result->num_rows === 0){
      require 'index.php';
      echo "<script>$(\".error_user\").css(\"visibility\",\"visible\")</script>";
  }
  else{
    while($user = $result->fetch_assoc()){
      if($user['Password']==$password){
        if($user['Role']=='prof'){
          $_SESSION['prof']=1;
        }
        else if($user['Role']=='student'){
          $_SESSION['student']=1;
        }
        else if($user['Role']=='secretariat'){
          $_SESSION['secretariat']=1;
        }
        $_SESSION['user']=$user['ID'];
        require 'welcome_login.php';
      }
      else{
        require 'index.php';
        echo "<script>$(\".error_pw\").css(\"visibility\",\"visible\")</script>";
      }
    }
  }



  $conn->close();

?>
