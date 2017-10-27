<?php

require_once "../inc/config.php";

session_start();
$stmt = $pdo->prepare("SELECT * FROM account WHERE uid=:uid");
$stmt->execute([
  "uid" => $_SESSION["data"]["uid"]
]);
$fetched = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<h1 class="page-header">Account Information</h1>
<b>User ID: </b><?php echo $fetched["uid"]; ?>
<br/>
<b>Username: </b><?php echo $fetched["username"]; ?>
<br/>
<b>Real name: </b><?php echo $fetched["realname"]; ?>
<br/>
<b>Student ID: </b><?php echo $fetched["student_id"]; ?>
<br/>
<b>Account type: </b><?php echo $fetched["account_type"]==1 ? "student" : "teacher"; ?>
<br/>
