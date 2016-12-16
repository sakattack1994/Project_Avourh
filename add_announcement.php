<?php
  $content="<div class=\"col-md-9\"><div id=\"content\">
  <div class=\"container\">
  <form action=\"announcements.php\" method=\"POST\" enctype=\"multipart/form-data\">
    <div class=\"form-group\">

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Announcement title:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <input type=\"text\" class=\"form-control\" name=\"ann_title\" placeholder=\"Insert announcement title\" required=\"\">
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Announcement content:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <textarea type=\"text\" rows=\"8\" cols=\"50\" class=\"form-control\" name=\"ann_content\" placeholder=\"Insert announcement content\" required=\"\"></textarea>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Add attachments to this announcement:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <input type=\"file\" name=\"ann_attachments[]\" multiple>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <label><h2>Category of the announcement:</h2></label>
        </div>
      </div>

      <div class=\"row\">
        <div class=\"col-md-8\">
          <select name=\"ann_category\" style=\"font-size=25px\">
            <option value=\"Graduate studies\">Graduate studies</option>
            <option value=\"Postgraduate\">Postgraduate</option>
            <option value=\"Phd studies\">Phd studies</option>
            <option value=\"Scholarships\">Scholarships</option>
          </select>
        </div>
      </div>
      <br>
      <div class=\"row\">
        <div class=\"col-md-8\"><input type=\"submit\" class=add_new_button value=\"&#9546;Add announcement\"></div>
      </div>

    </div>
  </form>
  </div>
  </div></div>
  <div class=\"col-md-3\"><div id=\"side_bar\"></div></div>";
  include 'WebPageTemplate.php';
?>
