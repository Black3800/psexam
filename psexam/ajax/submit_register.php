<?php

error_reporting(0);
require_once "../inc/config.php";

$data = json_decode($_POST["data"]);
$stmt = $pdo->prepare("INSERT INTO account VALUES (NULL, :usr, :pwd, :n, :sid, :acctype)");
$stmt->execute([
  "usr" => $data->username,
  "pwd" => password_hash($data->password, PASSWORD_BCRYPT),
  "n" => $data->realname,
  "sid" => $data->student_id,
  "acctype" => $data->account_type
]);
echo "User $data->username added.";

?>
