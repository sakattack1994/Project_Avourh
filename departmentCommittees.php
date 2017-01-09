<?php
  $alert="";
  if(isset($_POST['header']) OR isset($_POST['paragraph'])){
    $myfile = fopen("myresources/departmentCommittees.txt", "w") or die("Unable to open file!");
    ftruncate($myfile, 0);
    fwrite($myfile,"<h2>".$_POST['header']."</h2><br><p id=\"paragraph\">".$_POST['paragraph']."</p>");
    fclose($myfile);
    $alert="<div class=\"alert alert-success\"><strong>The edit was successful.</strong></div>";
  }
  $myfile = fopen("myresources/departmentCommittees.txt", "r") or die("Unable to open file!");
  $page=fread($myfile,filesize("myresources/departmentCommittees.txt"));
  $page=nl2br($page);

  preg_match('/<h2>(.*?)<\/h2>/siU',$page,$getTheHeader);
  $header=$getTheHeader[1];
  $header = html_entity_decode(strip_tags($header));

  preg_match('/<p id=\"paragraph\">(.*?)<\/p>/siU',$page,$getTheP);
  $paragraph=$getTheP[1];
  $paragraph = html_entity_decode(strip_tags($paragraph));

  $content="<div class=\"col-md-9\"><div id=\"content\">
      ".$page."
      <br>  <br>  <br>
      ".$alert."
      <form action=\"departmentCommittees.php\" id=\"edit_page\" method=\"POST\">
        <div class=\"form-group\">
            <h2 style=\"color:blue;\">Edit this page:</h2>
            <br>
            <h3>Page Header:</h3>
            <textarea type=\"text\" rows=\"2\" cols=\"10\" class=\"form-control\" name=\"header\">".$header."</textarea>
            <br>
            <h3>Page Content:</h3>
            <textarea type=\"text\" rows=\"15\" cols=\"10\" class=\"form-control\" name=\"paragraph\">".$paragraph."</textarea>
            <br>
            <input type=\"submit\" value=\"EDIT\" class=\"add_new_button\">
        </div>
      </form>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
  fclose($myfile);
?>
