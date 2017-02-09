<?php
    $publication="";
    $publication.="<div class=\"container\"><form action=\"my_publications.php\" method=\"POST\"><div class=\"form-group\">";
    $publication.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <label><h1>New scientific publication edit:</h1></label>
      </div>
    </div>";
    $publication.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <label><h1><h3>General information:</h3></h1></label>
      </div>
    </div>";
    $publication.="
    <div class=\"row\"><div class=\"col-md-8\">
    <table class=\"table table-bordered table-hover\" id=\"update_table\">
    <tr>
      <td>Title:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_title\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Year of Publish:</td><td style=\"padding:0;\"><input type=\"date\" name=\"new_date\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Description:</td><td style=\"padding:0;\"><textarea name=\"new_description\" rows=\"10\" cols=\"40\" style=\"height:100%; width:100%;\" required=\"\"></textarea></td>
    </tr>
    ";
    $publication.="</table></div></div>";
    $publication.="<br><br>
    <div class=\"row\"><div class=\"col-md-8\">
    <h3>If you finished creating press here:</h3>
    <input type=\"submit\" value=\"FINISH\" class=\"add_new_button\">
    </div></div>
    </div></form></div>
    <br><br>";
    $content="<div class=\"col-md-9\"><div id=\"content\">".$publication."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
?>
