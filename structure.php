<?php
  $alert="";
  if(isset($_POST['header']) OR isset($_POST['paragraph'])){
    $myfile = fopen("myresources/structure.txt", "w") or die("Unable to open file!");
    ftruncate($myfile, 0);
    fwrite($myfile,"<h2>".$_POST['header']."</h2><p id=\"par1\">".$_POST['par1']."</p><p id=\"par2\">".$_POST['par2']."</p><p id=\"par3\">".$_POST['par3']."</p><p id=\"par4\">".$_POST['par4']."</p>");
    fclose($myfile);
    $alert="<div class=\"alert alert-success\"><strong>The edit was successful.</strong></div>";
  }
  $myfile = fopen("myresources/structure.txt", "r") or die("Unable to open file!");
  $page=fread($myfile,filesize("myresources/structure.txt"));
  $page=nl2br($page);
  
  preg_match('/<h2>(.*?)<\/h2>/siU',$page,$getTheHeader);
  $header=$getTheHeader[1];
  $header = html_entity_decode(strip_tags($header));

  $par1="";
  $par2="";
  $par3="";
  $par4="";
  for($i=1;$i<5;$i++){
    $start = strpos($page, "<p id=\"par".$i."\">");
    $end = strpos($page, '</p>', $start);
    if($i==1){
      $par1 = substr($page, $start, $end-$start+4);
      $par1 = html_entity_decode(strip_tags($par1));
      $par1 = preg_replace( '/\h+/', ' ', $par1);
    }elseif ($i==2) {
      $par2 = substr($page, $start, $end-$start+4);
      $par2 = html_entity_decode(strip_tags($par2));
      $par2 = preg_replace( '/\h+/', ' ', $par2);
    }elseif ($i==3) {
      $par3 = substr($page, $start, $end-$start+4);
      $par3 = html_entity_decode(strip_tags($par3));
      $par3 = preg_replace( '/\h+/', ' ', $par3);
    }else{
      $par4 = substr($page, $start, $end-$start+4);
      $par4 = html_entity_decode(strip_tags($par4));
      $par4 = preg_replace( '/\h+/', ' ', $par4);
    }
  }
  $content="<div class=\"col-md-9\"><div id=\"content\">
      ".$page."
      <br>  <br>  <br>
      ".$alert."
      <form action=\"structure.php\" id=\"edit_page\" method=\"POST\">
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
            <br>
            <input type=\"submit\" value=\"EDIT\" class=\"add_new_button\">
        </div>
      </form>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
  fclose($myfile);
?>
