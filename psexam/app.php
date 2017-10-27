<?php

require_once "inc/config.php";

session_start();
if(empty($_SESSION["loggedin"]))
{
  header("location: login.php");
}

 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="css/common.css" />
  <link rel="stylesheet" href="css/app.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>
  <title>Potisarn Examination</title>
</head>
<body>
  <div class="container-fluid page-bg">
    <nav class="navbar navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php"><span style="color: var(--ps-blue)">Ps</span><span style="color: var(--ps-pink)">Exam</span></a>
        </div>
        <ul class="nav navbar-nav">
          <?php

          require_once "inc/app_navbar.inc.php";

          if($_SESSION["data"]["account_type"]===1)
          {
            output_navbar_nav(navbar_nav_all_exam);
            output_navbar_nav(navbar_nav_my_exam);
          }
          else
          {
            output_navbar_nav(navbar_nav_create_exam);
            output_navbar_nav(navbar_nav_input_score);
          }

           ?>
          <li id="account-nav">Account<i class="glyphicon glyphicon-user"></i></li>
          <li class="logout" id="logout-nav"><a href="logout.php">Logout<i class="glyphicon glyphicon-log-out"></i></a></li>
        </ul>
      </div>
    </nav>
    <div class="container page-content" id="page-content">
      <h1 class="text-center page-header" style="font-size: 3em">Welcome, <?php print($_SESSION["data"]["realname"]); ?></h1>
      <p class="text-center" style="font-size: 150%">Click one of the menu above to begin.</p>
      <div class="text-center" style="margin-top: 50px; opacity: 0.7;"><i class="glyphicon glyphicon-cog" style="font-size:5em; animation: spin 5s infinite"></i></div>
    </div>
  </div>
  <div id="alertUser_modal" class="modal fade" role="dialog">
    <div class="modal-dialog dialog-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" data-dismiss="modal">&times;</button>
          <h1 id="alertUser_modal-header"></h1>
        </div>
        <div class="modal-body" id="alertUser_modal-body"></div>
        <div class="modal-footer" id="alertUser_modal-footer">
          <button class="btn btn-default" id="alertUser_modal-close-btn" data-dismiss="modal"></button>
        </div>
      </div>
    </div>
  </div>
  <script src="js/navbar_nav_ev_handler.js"></script>
  <script src="js/navbar_nav_ev_binder.js"></script>
  <script src="js/app_main.js"></script>
</body>
</html>
