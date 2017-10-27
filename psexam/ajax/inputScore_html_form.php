<div class="form-group">
  <label class="control-label" for="exam_id">Exam name</label>
  <select class="form-control" id="exam_id" name="exam_id">
    <?php

    foreach ($fetched as $exam)
    {
      echo "<option value='" . $exam["exam_id"] . "'>" . $exam["exam_name"] . "</option>";
    }

    ?>
  </select>
</div>
<div class="form-group">
  <div id="inputScore-select-btn" class="btn btn-success pull-right" style="margin-top: 15px; width: 15%; height: 45px; font-size: 120%;">Select<i class="glyphicon glyphicon-ok"></i></div>
</div>
