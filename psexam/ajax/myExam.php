<?php

session_start();
if($_SESSION["data"]["account_type"]!==1)
{
  echo json_encode([
    "status" => 2,
    "pageContent" => null
  ]);
  exit();
}
ob_start();
require_once("myExam_html.php");
$pageContent = ob_get_clean();
ob_end_flush();
echo json_encode([
  "status" => 1,
  "pageContent" => $pageContent
]);

?>
