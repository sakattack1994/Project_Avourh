<?php
if(!isset($_SESSION))
    {
      session_start();
    }
?>
<html xmlns="http://www.w3.org/1999/xhtml" class="csstransforms no-csstransforms3d csstransitions">
  <head>
    <title></title>
    <link rel="shortcut icon" media="screen,print" href="Images/favicon.png" />
    <meta content="text/html; charset=UTF-8" http-equiv="content-type">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link rel="stylesheet" type="text/css" href="CSS/stylesheets.css">
    <link rel="stylesheet" type="text/css" href="CSS/menu.css">
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <link rel="stylesheet" type="text/css" href="CSS/user_menu.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script type="text/javascript" src="javascript/add_header.js"></script>
    <script type="text/javascript" src="javascript/add_footer.js"></script>
    <script type="text/javascript" src="javascript/intro_content.js"></script>
    <script type="text/javascript" src="javascript/user_menu.js"></script>
    <script type="text/javascript" src="javascript/general_functions.js"></script>
    <script type="text/javascript" src="javascript/general_scripts.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>

  <body background="background.jpg">
    <div class="container" >
      <div class="row">
          <div class="col-md-12"><div id="header"></div></div>
      </div>

      <div class="row">
       <?php echo $content; ?>
      </div>

    <div class="row">
        <div class="col-md-12"><div id="footer"></div></div>
    </div>
    </div>
<?php
if(isset($_SESSION['user'])){
  echo "<script>
  add_header();
  user_menu();
  add_footer();
  </script>";
}
else{
echo "<script>
add_header();
login();
add_footer();
</script>";
}
?>
    </body>
</html>
