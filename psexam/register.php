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
  <link rel="stylesheet" href="css/register.css" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <title>Register</title>
</head>
<body>
  <noscript>
    <div class="noscript">
      <h1>Um sorry.. this site requires javascript to run properly!</h1>
      <p>Know more about javascript <a href="https://www.enable-javascript.com/" target="_blank">here</a></p>
    </div>
  </noscript>
  <div class="container-fluid page-bg">
    <div class="container page-header text-center">
      <h1>Register</h1>
    </div>
    <div class="container page-content">
      <div class="form-group">
        <label for="account_type" class="control-label">Register as</label>
        <select class="form-control" name="account_type" id="account_type">
          <option value="1">Student</option>
          <option value="2">Teacher</option>
        </select>
      </div>
      <div class="form-group has-feedback" id="student_id_group">
        <label for="student_id" class="control-label">Student ID</label>
        <input type="text" class="form-control" name="student_id" id="student_id" placeholder="5-digit student id" />
        <span class="glyphicon form-control-feedback" data-feedback="student_id"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="username" class="control-label">Username</label>
        <input type="text" class="form-control" name="username" id="username" placeholder="username" />
        <span class="glyphicon form-control-feedback" data-feedback="username"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="password" class="control-label">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="password (more than 6 characters)" />
        <span class="glyphicon form-control-feedback" data-feedback="password"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="passwordcheck" class="control-label">Re-enter password</label>
        <input type="password" class="form-control" name="passwordcheck" id="passwordcheck" placeholder="verify password" />
        <span class="glyphicon form-control-feedback" data-feedback="passwordcheck"></span>
      </div>
      <div class="form-group has-feedback">
        <label for="realname" class="control-label">Name</label>
        <input type="text" class="form-control" name="realname" id="realname" placeholder="realname"/>
        <span class="glyphicon form-control-feedback" data-feedback="realname"></span>
      </div>
    </div>
    <div class="container submit-btn-container">
      <a href="index.php"><button class="btn back-btn">Back to home <i class="glyphicon glyphicon-home"></i></button></a>
      <button class="btn btn-success pull-right submit-btn" id="submit-btn" disabled>Register <i class="glyphicon glyphicon-ok"></i></button>
    </div>
  </div>
  <div id="infoModal" class="modal fade" role="dialog">
    <div class="modal-dialog dialog-sm">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title" id="modal-title">Successful</h3>
        </div>
        <div class="modal-body" id="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
  <script src="js/register.js"></script>
</body>
</html>
