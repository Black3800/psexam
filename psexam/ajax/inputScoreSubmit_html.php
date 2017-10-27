<?php

require_once "../inc/config.php";

$checkStmt = $pdo->prepare("SELECT student_uid FROM exam_result WHERE exam_id=:eid LIMIT 1");
$checkStmt->execute([
  "eid" => $_SESSION["exam_selected"]
]);
$isEdit = $checkStmt->fetch(PDO::FETCH_ASSOC);
$examStmt;
if(!empty($isEdit))
{
  $_SESSION["isEdit"] = true;
  $examStmt = $pdo->prepare(
    "SELECT account.uid, account.student_id, account.realname, exam_result.score
     FROM (((exam
       INNER JOIN exam_registered ON exam_registered.exam_id=exam.exam_id)
       INNER JOIN account ON account.uid=exam_registered.student_uid)
       INNER JOIN exam_result ON exam.exam_id=exam_result.exam_id
          AND exam_registered.student_uid=exam_result.student_uid)
     WHERE exam.exam_id=:eid");
}
else
{
  $_SESSION["isEdit"] = false;
  $examStmt = $pdo->prepare(
    "SELECT account.uid, account.student_id, account.realname
    FROM ((exam
      INNER JOIN exam_registered ON exam_registered.exam_id=exam.exam_id)
      INNER JOIN account ON account.uid=exam_registered.student_uid)
      WHERE exam.exam_id=:eid");
}
$examStmt->execute([
  "eid" => $_SESSION["exam_selected"]
]);
$thisExam = $examStmt->fetchAll(PDO::FETCH_ASSOC);
$nameStmt = $pdo->prepare("SELECT exam_name FROM exam WHERE exam_id=:eid");
$nameStmt->execute([
  "eid" => $_SESSION["exam_selected"]
]);
$examName = $nameStmt->fetch(PDO::FETCH_NUM);
if(count($thisExam)===0)
{
  echo json_encode([
    "status" => 4,
    "alert_head" => "Empty",
    "alert_text" => "<p>Sorry, no student registered to this exam.</p>"
  ]);
  exit();
}

?>
<h1 class="page-header">Input score for <?php echo $examName[0]; ?></h1>
<?php

if(!empty($isEdit))
{
  echo "<div class='alert alert-warning'>You are editing the previous score.</div>";
}

?>
<table class="table table-striped">
  <thead>
    <th>uid</th>
    <th>Student ID</th>
    <th>Name</th>
    <th>Score</th>
  </thead>
  <tbody>
    <?php

    foreach($thisExam as $exam)
    {
      echo "<tr>";
      echo "<td>" . $exam["uid"] . "</td>";
      echo "<td>" . $exam["student_id"] . "</td>";
      echo "<td>" . $exam["realname"] . "</td>";
      if(!empty($isEdit))
      {
        echo "<td><input type='number' id='score" .
          $exam["uid"] . "' data-uid='" . $exam["uid"] . "' value='" .
          $exam["score"] . "' class='form-control score-input'/></td>";
      }
      else
      {
        echo "<td><input type='number' id='score" .
          $exam["uid"] . "' data-uid='" . $exam["uid"] .
          "' class='form-control score-input'/></td>";
      }
      echo "</tr>";
    }

    ?>
  </tbody>
</table>
<div class="container" style="padding-right: 45px;">
  <div id="final-input-score-submit-btn" class="btn btn-success pull-right" style="font-size: 1.5em">Submit</div>
</div>
<script>
function getAllInput()
{
  var vals = [];
  document.querySelectorAll(".score-input").forEach((el)=>{
    var prop = {};
    prop.uid = el.getAttribute("data-uid");
    prop.score = !!parseInt(el.value) ? parseInt(el.value) : null;
    vals.push(prop);
  });
  return vals;
}

$("#final-input-score-submit-btn").on("click", ()=>{
  new page("finalInputScore", {
    data: getAllInput()
  });
});
</script>
