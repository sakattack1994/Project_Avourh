<?php
if(!isset($_SESSION))
    {
      session_start();
    }

  $alert="";
  if(isset($_POST['header'])){
    $myfile = fopen("myresources/currentAcademicYear.txt", "w") or die("Unable to open file!");
    ftruncate($myfile, 0);
    $txt="<h2>".$_POST['header']."</h2><p id=\"par\">".$_POST['par']."</p><p id=\"header1\" style=\"color:#000033; font-size:20px;\">".$_POST['header1']."</p><p id=\"par1\" style=\"color:#000099; font-size:18px;\">".$_POST['par1']."</p><p id=\"header2\" style=\"color:#000033; font-size:20px;\">".$_POST['header2']."
</p><p id=\"par2\" style=\"color:#000099; font-size:18px;\">".$_POST['par2']."</p><p id=\"header3\" style=\"color:#000033; font-size:20px;\">".$_POST['header3']."</p><p id=\"par3\" style=\"color:#000099; font-size:18px;\">".$_POST['par3']."</p>";
    fwrite($myfile,$txt);
    fclose($myfile);
    $alert="<div class=\"alert alert-success\"><strong>The edit was successful.</strong></div>";
  }
  $myfile = fopen("myresources/currentAcademicYear.txt", "r") or die("Unable to open file!");
  $page=fread($myfile,filesize("myresources/currentAcademicYear.txt"));
  $page=nl2br($page);

  preg_match('/<h2>(.*?)<\/h2>/siU',$page,$getTheHeader);
  $header=$getTheHeader[1];
  $header = html_entity_decode(strip_tags($header));

  $start = strpos($page, "<p id=\"par\">");
  $end = strpos($page, '</p>', $start);
  $par = substr($page, $start, $end-$start+4);
  $par = html_entity_decode(strip_tags($par));

  $par1="";
  $par2="";
  $par3="";
  $header1="";
  $header2="";
  $header3="";
  for($i=1;$i<4;$i++){
    $start = strpos($page, "<p id=\"par".$i."\" style=\"color:#000099; font-size:18px;\">");
    $end = strpos($page, '</p>', $start);
    $start1 = strpos($page, "<p id=\"header".$i."\" style=\"color:#000033; font-size:20px;\">");
    $end1 = strpos($page, '</p>', $start1);
    if($i==1){
      $par1 = substr($page, $start, $end-$start+4);
      $par1 = html_entity_decode(strip_tags($par1));
      $header1 = substr($page, $start1, $end1-$start1+4);
      $header1 = html_entity_decode(strip_tags($header1));
    }elseif ($i==2) {
      $par2 = substr($page, $start, $end-$start+4);
      $par2 = html_entity_decode(strip_tags($par2));
      $header2 = substr($page, $start1, $end1-$start1+4);
      $header2 = html_entity_decode(strip_tags($header2));
    }else{
      $par3 = substr($page, $start, $end-$start+4);
      $par3 = html_entity_decode(strip_tags($par3));
      $header3 = substr($page, $start1, $end1-$start1+4);
      $header3 = html_entity_decode(strip_tags($header3));
    }
  }

  if(isset($_SESSION['secretariat'])){
    $edit="<form action=\"currentAcademicYear.php\" id=\"edit_page\" method=\"POST\">
      <div class=\"form-group\">
          <h2 style=\"color:blue;\">Edit this page:</h2>
          <br>
          <h3>Page Header:</h3>
          <textarea type=\"text\" rows=\"2\" cols=\"10\" class=\"form-control\" name=\"header\">".$header."</textarea>
          <br>
          <h3>Page Content:</h3>
          <textarea type=\"text\" rows=\"2\" cols=\"10\" class=\"form-control\" name=\"par\">".$par."</textarea>
          <textarea type=\"text\" rows=\"2\" cols=\"10\" class=\"form-control\" name=\"header1\">".$header1."</textarea>
          <textarea type=\"text\" rows=\"10\" cols=\"10\" class=\"form-control\" name=\"par1\">".$par1."</textarea>
          <textarea type=\"text\" rows=\"2\" cols=\"10\" class=\"form-control\" name=\"header2\">".$header2."</textarea>
          <textarea type=\"text\" rows=\"10\" cols=\"10\" class=\"form-control\" name=\"par2\">".$par2."</textarea>
          <textarea type=\"text\" rows=\"2\" cols=\"10\" class=\"form-control\" name=\"header3\">".$header3."</textarea>
          <textarea type=\"text\" rows=\"10\" cols=\"10\" class=\"form-control\" name=\"par3\">".$par3."</textarea>
          <input type=\"submit\" value=\"EDIT\" class=\"add_new_button\">
      </div>
    </form>";
  }
  else{
    $edit="";
  }

  $content="<div class=\"col-md-9\"><div id=\"content\">
      ".$page."
      <br>  <br>  <br>
      ".$alert.$edit."
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
  fclose($myfile);
?>
