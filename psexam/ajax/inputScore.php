<?php

session_start();
if($_SESSION["data"]["account_type"]!==2)
{
  echo json_encode([
    "status" => 2,
    "pageContent" => null
  ]);
  exit();
}
ob_start();
require_once("inputScore_html.php");
$pageContent = ob_get_clean();
ob_end_flush();
echo json_encode([
  "status" => 1,
  "pageContent" => $pageContent
]);

?>
