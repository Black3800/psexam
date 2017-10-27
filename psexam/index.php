<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/common.css" />
    <link rel="stylesheet" href="css/index.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Potisarn Examination</title>
  </head>
  <body>
    <noscript>
      <div class="noscript">
        <h1>Um sorry.. this site requires javascript to run properly!</h1>
        <p>Know more about javascript <a href="https://www.enable-javascript.com/" target="_blank">here</a></p>
      </div>
    </noscript>
    <div class="container-fluid page-bg">
      <div class="container welcome-container">
        <h1 class="text-center">Welcome to Potisarn Examination</h1>
        <p>With this powerful application, you'll be able to do exams all over Potisarn Land.</p>
        <div class="container">
          <?php

          session_start();
          if(!empty($_SESSION["loggedin"]))
          {
            echo "<a href='app.php' style='font-size: 1.8em'>Proceed to app</a>";
          }
          else
          {
            echo '<a href="login.php">Login</a><a href="register.php">Sign up</a>';
          }

          ?>
        </div>
      </div>
    </div>
  </body>
</html>
