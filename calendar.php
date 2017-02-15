<?php
function draw_calendar($month,$year){
  $conn = new mysqli('localhost', 'root', '', 'mydepartment');
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  $sql='SET NAMES utf8';
  $result = $conn->query($sql);
  $hours = array("ΚΥΡΙΑΚΗ"=>"", "ΔΕΥΤΕΡΑ"=>"", "ΤΡΙΤΗ"=>"", "ΤΕΤΑΡΤΗ"=>"", "ΠΕΜΠΤΗ"=>"", "ΠΑΡΑΣΚΕΥΗ"=>"", "ΣΑΒΒΑΤΟ"=>"");
  $sql = "SELECT LessonID FROM students_lessons_enroll WHERE StudentID=\"".$_SESSION['user']."\"";
  $result = $conn->query($sql);
  while($id = $result->fetch_assoc()){
    $titlos="";
    $sql = "SELECT Title FROM lessons WHERE LessonID=\"".$id['LessonID']."\"";
    $result1 = $conn->query($sql);
    while($title = $result1->fetch_assoc()){
      $titlos=$title['Title'];
    }
    $sql = "SELECT * FROM lessons_hours WHERE LessonID=\"".$id['LessonID']."\"";
    $result2 = $conn->query($sql);
    while($dayhours = $result2->fetch_assoc()){
      $hours["".$dayhours['Day'].""] .= $titlos.":<br>".$dayhours['Hours']." ".$dayhours['Place']."<br><br>";
    }
  }
	/* draw table */
	$calendar = '<table cellpadding="0" cellspacing="0" class="calendar">';

	/* table headings */
	$headings = array('ΚΥΡΙΑΚΗ','ΔΕΥΤΕΡΑ','ΤΡΙΤΗ','ΤΕΤΑΡΤΗ','ΠΕΜΠΤΗ','ΠΑΡΑΣΚΕΥΗ','ΣΑΒΒΑΤΟ');
	$calendar.= '<tr class="calendar-row"><td class="calendar-day-head">'.implode('</td><td class="calendar-day-head">',$headings).'</td></tr>';

	/* days and weeks vars now ... */
	$running_day = date('w',mktime(0,0,0,$month,1,$year));
	$days_in_month = date('t',mktime(0,0,0,$month,1,$year));
	$days_in_this_week = 1;
	$day_counter = 0;
	$dates_array = array();

	/* row for week one */
	$calendar.= '<tr class="calendar-row">';

	/* print "blank" days until the first of the current week */
	for($x = 0; $x < $running_day; $x++):
		$calendar.= '<td class="calendar-day-np"> </td>';
		$days_in_this_week++;
	endfor;

	/* keep going with days.... */
	for($list_day = 1; $list_day <= $days_in_month; $list_day++):
		$calendar.= '<td class="calendar-day">';
			/* add in the day number */
    $calendar.= '<div class="day-number">'.$list_day.'</div>';
    $calendar.="<p>".$hours["".$headings[$running_day].""]."</p>";
		$calendar.= '</td>';
		if($running_day == 6):
			$calendar.= '</tr>';
			if(($day_counter+1) != $days_in_month):
				$calendar.= '<tr class="calendar-row">';
			endif;
			$running_day = -1;
			$days_in_this_week = 0;
		endif;
		$days_in_this_week++; $running_day++; $day_counter++;
	endfor;

	/* finish the rest of the days in the week */
	if($days_in_this_week < 8):
		for($x = 1; $x <= (8 - $days_in_this_week); $x++):
			$calendar.= '<td class="calendar-day-np"> </td>';
		endfor;
	endif;

	/* final row */
	$calendar.= '</tr>';

	/* end the table */
	$calendar.= '</table>';
  $conn->close();
	/* all done, return result */
	return $calendar;
}
//---------------------------------------------------------------------------------------------------------------
if(!isset($_SESSION))
    {
      session_start();
    }
    $month=(string)date('F');
    $year=(string)date('Y');
    $content="<div class=\"col-md-9\"><div id=\"content\">
      <h1>My calendar</h1>
      ".draw_calendar(date('m', strtotime($month)),$year)."
      <br>  <br>
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
?>
