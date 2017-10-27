<h1 class="page-header">Your registered exam</h1>
<table class="table table-striped">
  <thead>
    <th>ID</th>
    <th>Subject</th>
    <th>Exam name</th>
    <th>Venue</th>
    <th>Date &amp; time</th>
    <th>Teacher</th>
    <th>Score</th>
  </thead>
  <tbody>
    <?php

    require_once "../inc/config.php";

    $stmt = $pdo->prepare(
      "SELECT exam.*, subject.subject_name, account.realname, exam_result.score
       FROM ((((exam
          INNER JOIN exam_submitted ON exam.exam_id=exam_submitted.exam_id)
          INNER JOIN subject ON exam.subject_id=subject.subject_id)
          INNER JOIN account ON exam_submitted.teacher_uid=account.uid)
          LEFT JOIN exam_result ON exam.exam_id=exam_result.exam_id
            AND exam_result.student_uid=:sid)
       WHERE exam.exam_id
       IN (SELECT exam_id FROM exam_registered WHERE student_uid=:sid)");
    $stmt->execute([
      "sid" => intval($_SESSION["data"]["uid"])
    ]);
    $myExam = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach($myExam as $exam)
    {
      echo "<tr>";
      echo "<td>" . $exam["exam_id"]      . "</td>";
      echo "<td>" . $exam["subject_name"] . "</td>";
      echo "<td>" . $exam["exam_name"]    . "</td>";
      echo "<td>" . $exam["exam_place"]   . "</td>";
      echo "<td>" . $exam["exam_time"]    . "</td>";
      echo "<td>" . $exam["realname"]     . "</td>";
      if(isset($exam["score"]))
      {
        echo "<td>" . $exam["score"] . "</td>";
      }
      else
      {
        echo "<td>-</td>";
      }
      echo "</tr>";
    }

    ?>
  </tbody>
</table>
