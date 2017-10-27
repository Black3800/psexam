<?php

require_once "../inc/config.php";

session_start();
$stmt = $pdo->prepare("SELECT * FROM account WHERE username=:usr");
$stmt->execute(["usr" => $_POST["username"]]);
$fetched = $stmt->fetch();
if(!!$fetched["uid"])
{
  if(password_verify($_POST["password"], $fetched["password"]))
  {
    $data = [
      "status" => 1,
      "uid" => intval($fetched["uid"]),
      "realname" => $fetched["realname"],
      "student_id" => $fetched["student_id"],
      "account_type" => intval($fetched["account_type"])
    ];
    $_SESSION["loggedin"] = true;
    $_SESSION["data"] = $data;
    echo json_encode($data);
  }
  else
  {
    $_SESSION["loggedin"] = false;
    echo json_encode(["status" => 0]);
  }
}
else
{
  $_SESSION["loggedin"] = false;
  echo json_encode(["status" => 0]);
}

?>
