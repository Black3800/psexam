var app_main = (function(){

  var alertUser_modal =  {
    elem: $("#alertUser_modal")[0],
    call: function(md) {
      $("#alertUser_modal-body").html(md);
      if(!!arguments[1]) //modal header
      {
        $("#alertUser_modal-header").html(arguments[1]);
      }
      else
      {
        $("#alertUser_modal-header").html("Alert");
      }
      if(!!arguments[2]) //modal btn text
      {
        $("#alertUser_modal-close-btn").html(arguments[2]);
      }
      else
      {
        $("#alertUser_modal-close-btn").html("close");
      }
      if(!!arguments[3]) //modal btn color
      {
        $("#alertUser_modal-close-btn").css("background", arguments[3]);
      }
      else
      {
        $("#alertUser_modal-close-btn").css("background", "white");
      }
      $(alertUser_modal.elem).modal('show');
    }
  };

  var getPage = (url, data, callback) => {
    console.log(url + "'s request was sent");

    $.ajax("ajax/" + url + ".php", {
      method: 'get',
      data: data,
      success: (dat)=>{
        console.log("content received");
        console.log("calling callback");
        callback(dat);
      }
    });
  };
  var renderPage = (content) => {
    $("#page-content").html(content);
    console.log("content rendered " + Date());
  };

  return {
    alertUser: alertUser_modal.call,
    getPage: getPage,
    renderPage: renderPage
  }
})();

function page(url, getParams)
{
  this.url = url;
  this.pageReady = (data, status) => {
    data = JSON.parse(data);
    console.log("page ready, data: " + data.pageContent);
    this.render(data, status);
  }
  this.render = (data, status) => {
    if(data.status===1) //success
    {
      console.log(data);
      app_main.renderPage(data.pageContent);
    }
    else if(data.status===2) //forbidden
    {
      app_main.alertUser("There was some problem, please try again.", "Oops!");
    }
    else if(data.status===3) //redirect
    {
      new page(data.url);
    }
    else if(data.status===4) //custom alert
    {
      app_main.alertUser(data.alert_text, data.alert_head);
    }
    else if(data.status===5) //custom alert then redirect
    {
      app_main.alertUser(data.alert_text, data.alert_head);
      new page(data.url);
    }
    else //other err
    {
      app_main.alertUser("There was some problem, please try again.", "Oops!");
    }
  };
  app_main.getPage(url, getParams, this.pageReady);
}
