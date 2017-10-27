var inputCheck = (function(){
  var checked = {
    username: null,
    password: null,
    passwordcheck: null,
    realname: null,
    student_id: null,
    account_type: null
  };
  var omitted = false;
  var checkUsr = (val) => {
    $.ajax("ajax/check_register.php", {
      method: "post",
      data: { value: JSON.stringify({
        value: parseInt(val),
        checkType: 'username' })
      },
      success: (data) => {
        inputCheck.parseVal("username", JSON.parse(data).result);
      }
    });
  };

  var checkPassword = (val) => {
    $.ajax("ajax/check_register.php", {
      method: "post",
      data: { value: JSON.stringify({
        value: val,
        checkType: 'password' })
      },
      success: (data) => {
        inputCheck.parseVal("password", JSON.parse(data).result);
      }
    });
  };

  var checkPasswordMatch = (val1, val2) => {
    $.ajax("ajax/check_register.php", {
      method: "post",
      data: { value: JSON.stringify({
        value1: val1,
        value2: val2,
        checkType: 'passwordcheck' })
      },
      success: (data) => {
        inputCheck.parseVal("passwordcheck", JSON.parse(data).result);
      }
    });
  };

  var checkRealname = (val) => {
    $.ajax("ajax/check_register.php", {
      method: "post",
      data: { value: JSON.stringify({
        value: val,
        checkType: 'realname' })
      },
      success: (data) => {
        inputCheck.parseVal("realname", JSON.parse(data).result);
      }
    });
  };

  var checkStudentId = (val) => {
    if(omitted)
    {
      inputCheck.parseVal("student_id", true);
      return true;
    }
    $.ajax("ajax/check_register.php", {
      method: "post",
      data: { value: JSON.stringify({
        value: val,
        checkType: "student_id" })
      },
      success: (data) => {
        inputCheck.parseVal("student_id", JSON.parse(data).result);
      }
    })
  };

  var checkAccountType = (val) => {
    $.ajax("ajax/check_register.php", {
      method: "post",
      data: { value: JSON.stringify({
        value: parseInt(val),
        checkType: 'account_type' })
      },
      success: (data) => {
        inputCheck.parseVal("account_type", JSON.parse(data).result);
      }
    });
  };

  var omitStudentId = () => {
    inputCheck.parseVal("student_id", true);
    omitted = true;
  };

  var getChecked = () => {
    return checked;
  };

  var getSpecific = (field) => {
    return checked[field];
  };

  var parseVal = (field, data) => {
    checked[field] = data;
  };

  return {
    username: checkUsr,
    password: checkPassword,
    passwordcheck: checkPasswordMatch,
    realname: checkRealname,
    student_id: checkStudentId,
    account_type: checkAccountType,
    omitStudentId: omitStudentId,
    getChecked: getChecked,
    getSpecific: getSpecific,
    parseVal: parseVal
  }
})();

function checkAll()
{
  inputCheck.username($("#username").val());
  inputCheck.password($("#password").val());
  inputCheck.passwordcheck($("#password").val(),$("#passwordcheck").val());
  inputCheck.realname($("#realname").val());
  inputCheck.student_id($("#student_id").val());
  inputCheck.account_type($("#account_type").val());
}

function inputFieldGreen(el)
{
  $(el.parentElement).removeClass("has-error").addClass("has-success");
  $(".form-group.has-feedback span[data-feedback='" + el.id + "']").removeClass("glyphicon-remove").addClass("glyphicon-ok");
}

function inputFieldRed(el)
{
  $(el.parentElement).removeClass("has-success").addClass("has-error");
  $(".form-group.has-feedback span[data-feedback='" + el.id + "']").removeClass("glyphicon-ok").addClass("glyphicon-remove");
}

function cannotRegister()
{
  $("#submit-btn")[0].setAttribute("disabled", "true");
}

function canRegister()
{
  $("#submit-btn")[0].removeAttribute("disabled");
}

function invokeRegisterButton()
{
  if(arguments[0])
  {
    for (var i=0; i<arguments[0].length; i++)
    {
      if(!arguments[0][i][1])
      {
        if(!($("#account_type").val()=="2"&&arguments[0][i][0]=="account_type"))
        {
          cannotRegister();
          return false;
        }
      }
    }
    canRegister();
    return true;
  }
  var current;
  checkAll();
  setTimeout(()=>{
    current = inputCheck.getChecked();
    invokeRegisterButton(Object.entries(current));
  },500);
}

function submitRegister()
{
  var input = {
    username: $("#username").val(),
    password: $("#password").val(),
    passwordcheck: $("#passwordcheck").val(),
    realname: $("#realname").val(),
    student_id: $("#student_id").val(),
    account_type: $("#account_type").val()
  };
  $.ajax("ajax/submit_register.php", {
    method: "post",
    data: { data: JSON.stringify(input) },
    success: (data) => {
      $("#modal-title").html("Successful");
      $("#modal-body").html("<p>" + data + "</p>");
      $('#infoModal').modal({
        keyboard: true
      });
    }
  });
}

$(document).ready(function(){
  $("input").get().forEach((el)=>{
    if(el.id=="password")
    {
      el.addEventListener("change", ()=>{
        inputCheck.password(el.value);
        inputCheck.passwordcheck( $("#password").val(), el.value);
        setTimeout(() => {
          var check = inputCheck.getSpecific(el.id);
          if(check)
          {
            inputFieldGreen(el);
          }
          else
          {
            inputFieldRed(el);
          }
          check = inputCheck.getSpecific("passwordcheck");
          if(check)
          {
            inputFieldGreen($("#passwordcheck")[0]);
            invokeRegisterButton();
          }
          else
          {
            inputFieldRed($("#passwordcheck")[0]);
          }
        },500);
      });
    }
    else
    {
      el.addEventListener("change", ()=>{
        if(el.id=="passwordcheck")
        {
          inputCheck.passwordcheck( $("#password").val(), el.value);
        }
        else
        {
          inputCheck[el.id](el.value);
        }
        setTimeout(() => {
          var check = inputCheck.getSpecific(el.id);
          if(check)
          {
            inputFieldGreen(el);
            invokeRegisterButton();
          }
          else
          {
            inputFieldRed(el);
          }
        },500);
      });
    }
  });
  $("#account_type")[0].addEventListener("change", ()=>{
    if($("#account_type")[0].value=="1")
    {
      $("#student_id_group")[0].style.display = "block";
      $("#student_id")[0].value = "";
    }
    else
    {
      $("#student_id_group")[0].style.display = "none";
      $("#student_id")[0].value = "00000";
    }
  });
  $("#submit-btn")[0].addEventListener("click", ()=>{
    submitRegister();
  });
  $('#infoModal').on('hidden.bs.modal', function (e) {
    window.location.href="login.php";
  });
});
