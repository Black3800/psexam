<?php

session_start();
require_once "../inc/config.php";
$stmt = $pdo->prepare("INSERT INTO exam VALUES (null, :subject, :name, :place, :dtime)");
$stmt->execute([
  "subject" => $_GET["subject_id"],
  "name" => $_GET["exam_name"],
  "place" => $_GET["exam_place"],
  "dtime" => $_GET["exam_time"]
]);
$fetchStmt = $pdo->prepare("SELECT exam_id FROM exam WHERE subject_id=:subject AND exam_name=:name AND exam_place=:place AND exam_time=:dtime");
$fetchStmt->execute([
  "subject" => $_GET["subject_id"],
  "name" => $_GET["exam_name"],
  "place" => $_GET["exam_place"],
  "dtime" => $_GET["exam_time"]
]);
$fetched = $fetchStmt->fetch();
$_SESSION["submitted_exam_id"] = $fetched[0];
$stmt2 = $pdo->prepare("INSERT INTO exam_submitted VALUES (:tid, :eid)");
$stmt2->execute([
  "tid" => $_SESSION["data"]["uid"],
  "eid" => intval($fetched[0])
]);

ob_start();
require_once("createExamSubmit_html.php");
$pageContent = ob_get_clean();
ob_end_flush();
echo json_encode([
  "status" => 1,
  "pageContent" => $pageContent
]);

?>
