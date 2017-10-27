<?php

require_once "../inc/config.php";

session_start();
$stmt = $pdo->prepare("INSERT INTO exam_registered VALUES (:sid, :eid)");
$stmt->execute([
  "sid" => intval($_SESSION["data"]["uid"]),
  "eid" => intval($_SESSION["exam_try_register"])
]);
ob_start();
require_once("examRegister_continue_html.php");
$pageContent = ob_get_clean();
ob_end_flush();
echo json_encode([
  "status" => 1,
  "pageContent" => $pageContent
]);

?>
