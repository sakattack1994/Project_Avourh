<?php
    $book="";
    $book.="<div class=\"container\"><form action=\"books.php\" method=\"POST\" enctype=\"multipart/form-data\"><div class=\"form-group\">";
    $book.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <label><h1>New book edit:</h1></label>
      </div>
    </div>
    <div class=\"row\"><div class=\"col-md-8\">
    <table class=\"table table-bordered table-hover\" id=\"update_table\">
    <tr>
      <td>ISBN:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_isbn\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Τίτλος:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_title\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Συγγραφείς:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_author\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Έτος έκδοσης:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_yearofpubl\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Αριθμός έκδοσης:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_publno\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Εκδοτικός οίκος:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_publisher\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    <tr>
      <td>Περιγραφή:</td><td style=\"padding:0;\"><input type=\"text\" name=\"new_description\" style=\"height:100%; width:100%;\" required=\"\"></td>
    </tr>
    </table></div></div>";
    $book.="
    <div class=\"row\">
      <div class=\"col-md-8\">
        <label><h3>Add cover:</h3></label>
        <input name=\"file\" type=\"file\" id=\"file\" accept=\".png,.jpg,.bmp\">
      </div>
    </div>";
    $book.="<br><br>
    <div class=\"row\"><div class=\"col-md-8\">
    <h3>If you finished creating press here:</h3>
    <input type=\"submit\" value=\"FINISH\" class=\"add_new_button\">
    </div></div>
    </div></form></div>
    <br><br>";
    $content="<div class=\"col-md-9\"><div id=\"content\">".$book."
    </div></div>
    <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
    include 'WebPageTemplate.php';
?>
