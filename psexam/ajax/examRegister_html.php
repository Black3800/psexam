<?php

require_once "../inc/config.php";

$stmt = $pdo->prepare(
  "SELECT exam.*, account.realname
   FROM ((exam
      INNER JOIN exam_submitted ON exam.exam_id=exam_submitted.exam_id)
      INNER JOIN account ON exam_submitted.teacher_uid=account.uid)
   WHERE exam.exam_id=:eid");
$stmt->execute([
  "eid" => $_SESSION["exam_try_register"]
]);
$fetched = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<h1 class="page-header" style="font-size: 2em">Confirm?</h1>
<p style="font-size:1.5em">
  Are you sure to register to <b><?php echo htmlspecialchars($fetched["exam_name"]); ?></b>
  <i> (ID: <?php echo strval($fetched["exam_id"]); ?>)</i>
   from <b><?php echo htmlspecialchars($fetched["realname"]); ?></b> which is on
  <b><?php echo htmlspecialchars($fetched["exam_time"]); ?></b>
   at <b><?php echo htmlspecialchars($fetched["exam_place"]); ?></b>?
</p>
<div class="container" style="position: absolute; bottom: 20px; display: flex; justify-content: space-between; align-items: center; flex-flow: row; margin-top: 50px">
  <div class="btn btn-danger" id="exam-register-cancel" style="min-width: 10vw; height: 60px; line-height: 50px; font-size: 1.5em">Cancel</div>
  <div class="btn btn-success" id="exam-register-continue" style="min-width: 10vw; height: 60px; line-height: 50px; font-size: 1.5em">Continue</div>
</div>
<script>
$("#exam-register-cancel").on("click", ()=>{
  new page("examRegister_cancel");
});
$("#exam-register-continue").on("click", ()=>{
  new page("examRegister_continue");
});
</script>
