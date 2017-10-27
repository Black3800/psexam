function callModal(data)
{
  data = JSON.parse(data);
  if(data.status === 0)
  {
    failModal(data);
  }
  else
  {
    window.location.href = "app.php";
  }
}

function failModal(data)
{
  $("#modal-header").html("Login failed");
  $("#modal-body").html("<p>Either username or password is incorrect.</p>");
  $("#feedbackModal").modal({
    keyboard: true
  });
}

function login()
{
  $.ajax("ajax/login_process.php", {
    method: "post",
    data: {
      username: $("#username").val(),
      password: $("#password").val()
    },
    success: (data) => {
      callModal(data);
    }
  });
}

$(document).ready(function(){
  $("#login-btn").on("click", ()=>{
    login();
  });
  $(window).keydown(function (e){
    if(e.keyCode == 13){
      console.log(($("#feedbackModal").data('bs.modal') || {isShown: false}).isShown);
        if( ($("#feedbackModal").data('bs.modal') || {isShown: false}).isShown )
        {
          $("#feedbackModal").modal('hide');
        }
        else
        {
          login();
        }
    }
  });
  $("#username").focus();
});
