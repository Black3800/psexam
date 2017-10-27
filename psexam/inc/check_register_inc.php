<?php

require_once "config.php";

function checkUsername($usr)
{
  global $pdo;
  $stmt = $pdo->prepare("SELECT uid FROM account WHERE username=:usr");
  $stmt->execute(["usr" => $usr]);
  $fetched = $stmt->fetch();
  return !!$fetched[0];
}

?>
