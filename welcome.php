<?php
if(!isset($_SESSION))
    {
      session_start();
    }

  $alert="";
  if(isset($_POST['header']) OR isset($_POST['par1'])  OR isset($_POST['par2']) OR isset($_POST['par3']) OR isset($_POST['par4']) OR isset($_POST['par5'])){
    $myfile = fopen("myresources/welcome.txt", "w") or die("Unable to open file!");
    ftruncate($myfile, 0);
    fwrite($myfile,"<h2>".$_POST['header']."</h2><p id=\"par1\" style=\"text-align:left;\">".$_POST['par1']."</p><p id=\"par2\" style=\"text-align:left;\">".$_POST['par2']."</p><p id=\"par3\" style=\"text-align:left;\">".$_POST['par3']."</p><p id=\"par4\" style=\"text-align:left;\">".$_POST['par4']."</p><p id=\"par5\" style=\"text-align:left;\">".$_POST['par5']."</p>");
    fclose($myfile);
    $alert="<div class=\"alert alert-success\"><strong>The edit was successful.</strong></div>";
  }
  $myfile = fopen("myresources/welcome.txt", "r") or die("Unable to open file!");
  $page=fread($myfile,filesize("myresources/welcome.txt"));
  $page=nl2br($page);

  preg_match('/<h2>(.*?)<\/h2>/siU',$page,$getTheHeader);
  $header=$getTheHeader[1];
  $header = html_entity_decode(strip_tags($header));

  $par1="";
  $par2="";
  $par3="";
  $par4="";
  $par5="";
  for($i=1;$i<6;$i++){
    $start = strpos($page, "<p id=\"par".$i."\" style=\"text-align:left;\">");
    $end = strpos($page, '</p>', $start);
    if($i==1){
      $par1 = substr($page, $start, $end-$start+4);
      $par1 = html_entity_decode(strip_tags($par1));
    }elseif ($i==2) {
      $par2 = substr($page, $start, $end-$start+4);
      $par2 = html_entity_decode(strip_tags($par2));
    }elseif ($i==3) {
      $par3 = substr($page, $start, $end-$start+4);
      $par3 = html_entity_decode(strip_tags($par3));
    }elseif ($i==4) {
      $par4 = substr($page, $start, $end-$start+4);
      $par4 = html_entity_decode(strip_tags($par4));
    }else{
      $par5 = substr($page, $start, $end-$start+4);
      $par5 = html_entity_decode(strip_tags($par5));
    }
  }
  if(isset($_SESSION['secretariat'])){
    $edit="<form action=\"welcome.php\" id=\"edit_page\" method=\"POST\">
      <div class=\"form-group\">
          <h2 style=\"color:blue;\">Edit this page:</h2>
          <br>
          <h3>Page Header:</h3>
          <textarea type=\"text\" rows=\"2\" cols=\"10\" class=\"form-control\" name=\"header\">".$header."</textarea>
          <br>
          <h3>Paragraph 1:</h3>
          <textarea type=\"text\" rows=\"10\" cols=\"10\" class=\"form-control\" name=\"par1\">".$par1."</textarea>
          <h3>Paragraph 2:</h3>
          <textarea type=\"text\" rows=\"10\" cols=\"10\" class=\"form-control\" name=\"par2\">".$par2."</textarea>
          <h3>Paragraph 3:</h3>
          <textarea type=\"text\" rows=\"10\" cols=\"10\" class=\"form-control\" name=\"par3\">".$par3."</textarea>
          <h3>Paragraph 4:</h3>
          <textarea type=\"text\" rows=\"10\" cols=\"10\" class=\"form-control\" name=\"par4\">".$par4."</textarea>
          <h3>Paragraph 5:</h3>
          <textarea type=\"text\" rows=\"10\" cols=\"10\" class=\"form-control\" name=\"par5\">".$par5."</textarea>
          <br>
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
