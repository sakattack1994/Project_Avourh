<?php
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $first_semester_lessons="";
  $second_semester_lessons="";
  $third_semester_lessons="";
  $fourth_semester_lessons="";
  $fifth_semester_lessons="";
  $sixth_semester_lessons="";
  $seventh_semester_lessons="";
  $eight_semester_lessons="";
  $nine_semester_lessons="";
  $ten_semester_lessons="";
  $sql = "SELECT Title,LessonID FROM lessons WHERE Semester=1";
  $result = $conn->query($sql);
  while($temp = $result->fetch_assoc()){
    $sql = "SELECT ProfessorID,FirstName,LastName FROM professors";
    $profs = $conn->query($sql);
    $prof_list="";
    while($temp2 = $profs->fetch_assoc()){
      $prof_list.="<input type=\"checkbox\" name=\"1s".$temp['LessonID']."[]\" value=\"".$temp2['ProfessorID']."\">".$temp2['LastName']." ".$temp2['FirstName'];
    }
    $first_semester_lessons.="
    <div><input type=\"checkbox\" name=\"1s[]\" value=\"".$temp['LessonID']."\" onclick=check(\"".$temp['LessonID']."\") id=\"lchoose".$temp['LessonID']."\">".$temp['LessonID'].":".$temp['Title']."
    <div class=\"profs".$temp['LessonID']."\" style=\"visibility: hidden;display:none\">".$prof_list."</div>
    </div>
    <br>
    ";
  }
  $prof_list="";
  $sql = "SELECT Title,LessonID FROM lessons WHERE Semester=2";
  $result = $conn->query($sql);
  while($temp = $result->fetch_assoc()){
    $sql = "SELECT ProfessorID,FirstName,LastName FROM professors";
    $profs = $conn->query($sql);
    while($temp2 = $profs->fetch_assoc()){
      $prof_list.="<input type=\"checkbox\" name=\"2s".$temp['LessonID']."[]\" value=\"".$temp2['ProfessorID']."\">".$temp2['LastName']." ".$temp2['FirstName'];
    }
    $second_semester_lessons.="
    <div><input type=\"checkbox\" name=\"2s[]\" value=\"".$temp['LessonID']."\" onclick=check(\"".$temp['LessonID']."\") id=\"lchoose".$temp['LessonID']."\">".$temp['LessonID'].":".$temp['Title']."
    <div class=\"profs".$temp['LessonID']."\" style=\"visibility: hidden;display:none\">".$prof_list."</div>
    </div>
    <br>
    ";
  }
  $prof_list="";
  $sql = "SELECT Title,LessonID FROM lessons WHERE Semester=3";
  $result = $conn->query($sql);
  while($temp = $result->fetch_assoc()){
    $sql = "SELECT ProfessorID,FirstName,LastName FROM professors";
    $profs = $conn->query($sql);
    while($temp2 = $profs->fetch_assoc()){
      $prof_list.="<input type=\"checkbox\" name=\"3s".$temp['LessonID']."[]\" value=\"".$temp2['ProfessorID']."\">".$temp2['LastName']." ".$temp2['FirstName'];
    }
    $third_semester_lessons.="
    <div><input type=\"checkbox\" name=\"3s[]\" value=\"".$temp['LessonID']."\" onclick=check(\"".$temp['LessonID']."\") id=\"lchoose".$temp['LessonID']."\">".$temp['LessonID'].":".$temp['Title']."
    <div class=\"profs".$temp['LessonID']."\" style=\"visibility: hidden;display:none\">".$prof_list."</div>
    </div>
    <br>
      ";
  }
  $prof_list="";
  $sql = "SELECT Title,LessonID FROM lessons WHERE Semester=4";
  $result = $conn->query($sql);
  while($temp = $result->fetch_assoc()){
    $sql = "SELECT ProfessorID,FirstName,LastName FROM professors";
    $profs = $conn->query($sql);
    while($temp2 = $profs->fetch_assoc()){
      $prof_list.="<input type=\"checkbox\" name=\"4s".$temp['LessonID']."[]\" value=\"".$temp2['ProfessorID']."\">".$temp2['LastName']." ".$temp2['FirstName'];
    }
    $fourth_semester_lessons.="
    <div><input type=\"checkbox\" name=\"4s[]\" value=\"".$temp['LessonID']."\" onclick=check(\"".$temp['LessonID']."\") id=\"lchoose".$temp['LessonID']."\">".$temp['LessonID'].":".$temp['Title']."
    <div class=\"profs".$temp['LessonID']."\" style=\"visibility: hidden;display:none\">".$prof_list."</div>
    </div>
    <br>
    ";
  }
  $prof_list="";
  $sql = "SELECT Title,LessonID FROM lessons WHERE Semester=5";
  $result = $conn->query($sql);
  while($temp = $result->fetch_assoc()){
    $sql = "SELECT ProfessorID,FirstName,LastName FROM professors";
    $profs = $conn->query($sql);
    while($temp2 = $profs->fetch_assoc()){
      $prof_list.="<input type=\"checkbox\" name=\"5s".$temp['LessonID']."[]\" value=\"".$temp2['ProfessorID']."\">".$temp2['LastName']." ".$temp2['FirstName'];
    }
    $fifth_semester_lessons.="
    <div><input type=\"checkbox\" name=\"5s[]\" value=\"".$temp['LessonID']."\" onclick=check(\"".$temp['LessonID']."\") id=\"lchoose".$temp['LessonID']."\">".$temp['LessonID'].":".$temp['Title']."
    <div class=\"profs".$temp['LessonID']."\" style=\"visibility: hidden;display:none\">".$prof_list."</div>
    </div>
    <br>
    ";
  }
  $prof_list="";
  $sql = "SELECT Title,LessonID FROM lessons WHERE Semester=6";
  $result = $conn->query($sql);
  while($temp = $result->fetch_assoc()){
    $sql = "SELECT ProfessorID,FirstName,LastName FROM professors";
    $profs = $conn->query($sql);
    while($temp2 = $profs->fetch_assoc()){
      $prof_list.="<input type=\"checkbox\" name=\"6s".$temp['LessonID']."[]\" value=\"".$temp2['ProfessorID']."\">".$temp2['LastName']." ".$temp2['FirstName'];
    }
    $sixth_semester_lessons.="
    <div><input type=\"checkbox\" name=\"6s[]\" value=\"".$temp['LessonID']."\" onclick=check(\"".$temp['LessonID']."\") id=\"lchoose".$temp['LessonID']."\">".$temp['LessonID'].":".$temp['Title']."
    <div class=\"profs".$temp['LessonID']."\" style=\"visibility: hidden;display:none\">".$prof_list."</div>
    </div>
    <br>
    ";
  }
  $prof_list="";
  $sql = "SELECT Title,LessonID FROM lessons WHERE Semester=7";
  $result = $conn->query($sql);
  while($temp = $result->fetch_assoc()){
    $sql = "SELECT ProfessorID,FirstName,LastName FROM professors";
    $profs = $conn->query($sql);
    while($temp2 = $profs->fetch_assoc()){
      $prof_list.="<input type=\"checkbox\" name=\"7s".$temp['LessonID']."[]\" value=\"".$temp2['ProfessorID']."\">".$temp2['LastName']." ".$temp2['FirstName'];
    }
    $seventh_semester_lessons.="
    <div><input type=\"checkbox\" name=\"7s[]\" value=\"".$temp['LessonID']."\" onclick=check(\"".$temp['LessonID']."\") id=\"lchoose".$temp['LessonID']."\">".$temp['LessonID'].":".$temp['Title']."
    <div class=\"profs".$temp['LessonID']."\" style=\"visibility: hidden;display:none\">".$prof_list."</div>
    </div>
    <br>
    ";
  }
  $prof_list="";
  $sql = "SELECT Title,LessonID FROM lessons WHERE Semester=8";
  $result = $conn->query($sql);
  while($temp = $result->fetch_assoc()){
    $sql = "SELECT ProfessorID,FirstName,LastName FROM professors";
    $profs = $conn->query($sql);
    while($temp2 = $profs->fetch_assoc()){
      $prof_list.="<input type=\"checkbox\" name=\"8s".$temp['LessonID']."[]\" value=\"".$temp2['ProfessorID']."\">".$temp2['LastName']." ".$temp2['FirstName'];
    }
    $eight_semester_lessons.="
    <div><input type=\"checkbox\" name=\"8s[]\" value=\"".$temp['LessonID']."\" onclick=check(\"".$temp['LessonID']."\") id=\"lchoose".$temp['LessonID']."\">".$temp['LessonID'].":".$temp['Title']."
    <div class=\"profs".$temp['LessonID']."\" style=\"visibility: hidden;display:none\">".$prof_list."</div>
    </div>
    <br>
    ";
  }
  $prof_list="";
  $sql = "SELECT Title,LessonID FROM lessons WHERE Semester=9";
  $result = $conn->query($sql);
  while($temp = $result->fetch_assoc()){
    $sql = "SELECT ProfessorID,FirstName,LastName FROM professors";
    $profs = $conn->query($sql);
    while($temp2 = $profs->fetch_assoc()){
      $prof_list.="<input type=\"checkbox\" name=\"9s".$temp['LessonID']."[]\" value=\"".$temp2['ProfessorID']."\">".$temp2['LastName']." ".$temp2['FirstName'];
    }
    $nine_semester_lessons.="
    <div><input type=\"checkbox\" name=\"9s[]\" value=\"".$temp['LessonID']."\" onclick=check(\"".$temp['LessonID']."\") id=\"lchoose".$temp['LessonID']."\">".$temp['LessonID'].":".$temp['Title']."
    <div class=\"profs".$temp['LessonID']."\" style=\"visibility: hidden;display:none\">".$prof_list."</div>
    </div>
    <br>
    ";
  }
  $prof_list="";
  $sql = "SELECT Title,LessonID FROM lessons WHERE Semester=10";
  $result = $conn->query($sql);
  while($temp = $result->fetch_assoc()){
    $sql = "SELECT ProfessorID,FirstName,LastName FROM professors";
    $profs = $conn->query($sql);
    while($temp2 = $profs->fetch_assoc()){
      $prof_list.="<input type=\"checkbox\" name=\"10s".$temp['LessonID']."[]\" value=\"".$temp2['ProfessorID']."\">".$temp2['LastName']." ".$temp2['FirstName'];
    }

    $ten_semester_lessons.="
    <div><input type=\"checkbox\" name=\"10s[]\" value=\"".$temp['LessonID']."\" onclick=check(\"".$temp['LessonID']."\") id=\"lchoose".$temp['LessonID']."\">".$temp['LessonID'].":".$temp['Title']."
    <div class=\"profs".$temp['LessonID']."\" style=\"visibility: hidden;display:none\">".$prof_list."</div>
    </div>
    <br>
    ";
  }
  $prof_list="";
  $conn->close();
  $content="<div class=\"col-md-9\"><div id=\"content\">
  <div class=\"container\">
  <form action=\"study_schedule.php\" method=\"POST\" enctype=\"multipart/form-data\">
    <div class=\"form-group\">

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Study guide period:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-4\">
          <label>Starting year:</label>
          <input type=\"text\" class=\"form-control\" name=\"starting_year\" placeholder=\"starting year\" required=\"\">
        </div>
        <div class=\"col-md-4\">
          <label>Ending year:</label>
          <input type=\"text\" class=\"form-control\" name=\"ending_year\" placeholder=\"ending year\" required=\"\">
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Choose lessons to add to 1st semester:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
        ".$first_semester_lessons."
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Choose lessons to add to 2nd semester:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
        ".$second_semester_lessons."
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Choose lessons to add to 3rd semester:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
        ".$third_semester_lessons."
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Choose lessons to add to 4th semester:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
        ".$fourth_semester_lessons."
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Choose lessons to add to 5th semester:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
        ".$fifth_semester_lessons."
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Choose lessons to add to 6th semester:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
        ".$sixth_semester_lessons."
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Choose lessons to add to 7th semester:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
        ".$seventh_semester_lessons."
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Choose lessons to add to 8th semester:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
        ".$eight_semester_lessons."
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Choose lessons to add to 9th semester:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
        ".$nine_semester_lessons."
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Choose lessons to add to 10th semester:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
        ".$ten_semester_lessons."
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\"><input type=\"submit\" class=add_new_button value=\"Complete study guide\"></div>
      </div>

    </div>
  </form>
  </div>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
