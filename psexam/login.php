<?php

session_start();
if(!empty($_SESSION["loggedin"]))
{
  header("location: app.php");
}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/login.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Login</title>
  </head>
  <body>
    <noscript>
      <div class="noscript">
        <h1>Um sorry.. this site requires javascript to run properly!</h1>
        <p>Know more about javascript <a href="https://www.enable-javascript.com/" target="_blank">here</a></p>
      </div>
    </noscript>
    <div class="container-fluid page-bg">
      <div class="container page-header"><h1 class="text-center">Login</h1></div>
      <div class="container login-container">
        <div class="form-group has-feedback">
          <label for="username" class="control-label">Username</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input type="text" name="username" id="username" class="form-control" placeholder="username"/>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label for="password" class="control-label">Password</label>
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
            <input type="password" name="password" id="password" class="form-control" placeholder="password"/>
          </div>
        </div>
        <div class="container login-btn-container">
          <button class="btn btn-success" id="login-btn">Login <span class="glyphicon glyphicon-log-in"></span></button>
        </div>
      </div>
      <a href="index.php"><button class="btn back-btn">Back to home <i class="glyphicon glyphicon-home"></i></button></a>
    </div>
    <div id="feedbackModal" class="modal fade" role="dialog">
      <div class="modal-dialog dialog-sm">
        <div class="modal-content">
          <div class="modal-header">
            <button class="close" data-dismiss="modal">&times;</button>
            <h3 id="modal-header"></h3>
          </div>
          <div class="modal-body" id="modal-body"></div>
          <div class="modal-footer">
            <button class="btn btn-danger" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <script src="js/login.js"></script>
  </body>
</html>
