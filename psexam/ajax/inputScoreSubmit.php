<?php

session_start();
$_SESSION["exam_selected"] = intval($_GET["exam_id"]);
ob_start();
require_once("inputScoreSubmit_html.php");
$pageContent = ob_get_clean();
ob_end_flush();
echo json_encode([
  "status" => 1,
  "pageContent" => $pageContent
]);

?>
