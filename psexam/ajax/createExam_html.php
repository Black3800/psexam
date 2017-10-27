<h1 class="page-header">Create new exam</h1>
<form>
  <div class="form-group">
    <div class="form-group">
      <label class="control-label" for="exam_name">Exam name</label>
      <input type="text" name="exam_name" id="exam_name" class="form-control" />
    </div>
    <div class="form-group">
      <label class="control-label" for="subject_id">Exam name</label>
      <select class="form-control" id="subject_id" name="subject_id">
        <option value="1">Thai</option>
        <option value="2">Mathematics</option>
        <option value="3">Sociology</option>
        <option value="4">Science</option>
        <option value="5">English</option>
      </select>
    </div>
    <div class="form-group">
      <label class="control-label" for="exam_place">Examination venue</label>
      <input type="text" name="exam_place" id="exam_place" class="form-control" />
    </div>
    <label class="control-label" for="exam_time">Examination date and time</label>
    <div class="input-group date">
      <input type="text" name="exam_time" id="exam_time" class="form-control" />
      <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
      </div>
    </div>
    <div id="create-exam-submit-btn" class="btn btn-success pull-right" style="margin-top: 15px; width: 15%; height: 45px; font-size: 120%;">Create<i class="glyphicon glyphicon-ok"></i></div>
  </div>
</form>
<script>
$(function(){
  $("#exam_time").datetimepicker();
});

$("#create-exam-submit-btn").on("click",function(){
  new page("createExamSubmit", {
    subject_id: $("#subject_id").val(),
    exam_name: $("#exam_name").val(),
    exam_place: $("#exam_place").val(),
    exam_time: $("#exam_time").val()
  });
});
</script>
