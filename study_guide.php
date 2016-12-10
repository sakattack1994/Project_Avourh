<?php
  $name="study_guide_2016-2017";
  if(isset($_POST['study_guides'])){
    $name = $_POST['study_guides'];
  }
  $content="
  <div class=\"col-md-9\">
    <div id=\"content\">
      <h1>Study guides</h1>
      <form enctype=\"multipart/form-data\" action=\"study_guide.php\" method=\"post\">
        <label><h3>Add new study guide:</h3></label>
        <input name=\"file\" type=\"file\" id=\"file\" size=\"2000\" >
        <input type=\"submit\" class=\"add_new_button\" value=\"Upload\">
      </form>
      <label>Choose the study guide you want to see:</label>
      <form action=\"study_guide.php\" method=\"post\">
        <select name=\"study_guides\" style=\"font-size=25px\">
          <option value=\"study_guide_2016-2017\">Study guide 2016-2017</option>
          <option value=\"study_guide_2015-2016\">Study guide 2015-2016</option>
          <option value=\"study_guide_2014-2015\">Study guide 2014-2015</option>
        </select>
        <input type=\"submit\" value=\"Show\">
      </form>
      <iframe src = \"/dokimes/javascript/ViewerJS/#../../resources/study_guide/".$name.".pdf\" width=700 height=600 allowfullscreen webkitallowfullscreen></iframe>
    </div>
  </div>
    <div class=\"col-md-3\">
      <div id=\"side_bar\">
    </div>
  </div>";
  include 'WebPageTemplate.php';
?>
