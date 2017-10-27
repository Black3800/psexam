<?php

require_once "../inc/config.php";
session_start();
if($_SESSION["isEdit"])
{
  $scores = "UPDATE exam_result SET score = CASE student_uid";
  foreach($_GET["data"] as $scoreRow)
  {
    $scores .= " WHEN " . $scoreRow["uid"] . " THEN " . $scoreRow["score"];
  }
  $scores .= " ELSE NULL END WHERE exam_id=:eid";
  $scoreStmt = $pdo->prepare($scores);
  $scoreStmt->execute([
    "eid" => $_SESSION["exam_selected"]
  ]);
}
else
{
  $scores = "";
  foreach($_GET["data"] as $scoreRow)
  {
    $scores .= "(";
    $scores .= $_SESSION["exam_selected"];
    $scores .= ",";
    $scores .= $scoreRow["uid"];
    $scores .= ",";
    if(empty($scoreRow["score"]))
    {
      $scores .= "null";
    }
    else
    {
      $scores .= $scoreRow["score"];
    }
    $scores .= "),";
  }
  $scores = substr($scores, 0, -1);
  $scoreStmt = $pdo->prepare("INSERT INTO exam_result VALUES $scores");
  $scoreStmt->execute();
}
echo json_encode([
  "status" => 5,
  "alert_head" => "Successful",
  "alert_text" => "<p>Scores have been inputted into the database.</p>",
  "url" => "inputScore"
]);

?>
