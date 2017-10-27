<h1 class="page-header">Newest exams</h1>
<table class="table table-striped">
  <thead>
    <th>ID</th>
    <th>Subject</th>
    <th>Exam name</th>
    <th>Venue</th>
    <th>Date &amp; Time</th>
    <th>Teacher</th>
    <th>Register</th>
  </thead>
  <tbody>
    <?php

    require_once "../inc/config.php";

    $stmt = $pdo->prepare(
      "SELECT exam.*, subject.subject_name, account.realname
       FROM (((exam
         INNER JOIN exam_submitted ON exam.exam_id=exam_submitted.exam_id)
         INNER JOIN subject ON exam.subject_id=subject.subject_id)
         INNER JOIN account ON exam_submitted.teacher_uid=account.uid)
       ORDER BY exam.exam_id DESC
       LIMIT 50");
    $stmt->execute();
    $fetched = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach($fetched as $exam)
    {
      echo "<tr>";
      echo "<td>" . $exam['exam_id']    . "</td>";
      echo "<td>" . $exam['subject_name'] . "</td>";
      echo "<td>" . $exam['exam_name']  . "</td>";
      echo "<td>" . $exam['exam_place'] . "</td>";
      echo "<td>" . $exam['exam_time']  . "</td>";
      echo "<td>" . $exam['realname']  . "</td>";
      echo "<td><div class='btn btn-success exam-register-btn' data-exam-id='" .
        $exam['exam_id'] . "'>Register</div></td>";
      echo "</tr>";
    }

    ?>
  </tbody>
</table>
<script>
$(".exam-register-btn").get().forEach((el)=>{
  var elId = el.getAttribute("data-exam-id");
  el.addEventListener("click", ()=>{
    new page("examRegister", {
      exam_id: elId
    });
  });
});
</script>
