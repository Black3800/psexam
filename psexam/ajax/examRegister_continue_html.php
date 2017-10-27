<?php

require_once "../inc/config.php";

$getName = $pdo->prepare("SELECT exam_name FROM exam WHERE exam_id=:eid");
$getName->execute([
  "eid" => $_SESSION["exam_try_register"]
]);
$fetched = $getName->fetch(PDO::FETCH_ASSOC);

?>
<h1 class="page-header" style="font-size: 2em">Sucessful</h1>
<p style="font-size: 1.5em">You are registered to <b><?php
echo $fetched["exam_name"];
?></b></p>
