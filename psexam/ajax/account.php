<?php

ob_start();
require_once("account_html.php");
$pageContent = ob_get_clean();
ob_end_flush();
echo json_encode([
  "status" => 1,
  "pageContent" => $pageContent
]);

?>
