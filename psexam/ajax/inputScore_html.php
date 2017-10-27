<h1 class="page-header">Input score</h1>
<form>
  <?php

  require_once "../inc/config.php";

  $stmt = $pdo->prepare("SELECT exam_id,exam_name FROM exam WHERE exam_id IN (SELECT exam_id FROM exam_submitted WHERE teacher_uid=:tid)");
  $stmt->execute([
    "tid" => intval($_SESSION["data"]["uid"])
  ]);
  $fetched = $stmt->fetchAll(PDO::FETCH_ASSOC);
  $isEmpty = empty($fetched);
  if($isEmpty)
  {
    echo "<h1>You don't have any exam yet.</h1>";
  }
  else
  {
    ob_start();
    require_once("inputScore_html_form.php");
    $formBuffer = ob_get_clean();
    echo $formBuffer;
  }

  ?>
</form>
<script>
$("#inputScore-select-btn").on("click", function(){
  new page("inputScoreSubmit", {
    exam_id: $("#exam_id").val()
  });
});
</script>
