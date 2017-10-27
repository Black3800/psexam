<?php

require_once "../inc/config.php";

session_start();
if($_SESSION["data"]["account_type"]!==1)
{
  echo json_encode([
    "status" => 2,
    "pageContent" => null
  ]);
  exit();
}
$_SESSION["exam_try_register"] = $_GET["exam_id"];
$checkRegister = $pdo->prepare("SELECT student_uid FROM exam_registered WHERE student_uid=:sid AND exam_id=:eid");
$checkRegister->execute([
  "sid" => intval($_SESSION["data"]["uid"]),
  "eid" => intval($_SESSION["exam_try_register"])
]);
$isRegistered = $checkRegister->fetch(PDO::FETCH_ASSOC);
if(!empty($isRegistered))
{
  echo json_encode([
    "status" => 4,
    "alert_text" => "<p>You are already registered to this exam.</p>",
    "alert_head" => "Failed"
  ]);
  exit();
}
ob_start();
require_once("examRegister_html.php");
$pageContent = ob_get_clean();
ob_end_flush();
echo json_encode([
  "status" => 1,
  "pageContent" => $pageContent
]);

?>
