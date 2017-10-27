$(document).ready(function(){
  $("#account-nav").on("click", navbar_nav.account);
  $("#navbar_nav_all_exam").on("click", navbar_nav.allExam);
  $("#navbar_nav_my_exam").on("click", navbar_nav.myExam);
  $("#navbar_nav_create_exam").on("click", navbar_nav.createExam);
  $("#navbar_nav_input_score").on("click", navbar_nav.inputScore);
});
