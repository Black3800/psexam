var navbar_nav = (function(){

  var account = () => {
      new page("account");
  };

  var allExam = () => {
    new page("allExam");
  };

  var myExam = () => {
    new page("myExam");
  };

  var createExam = () => {
    new page("createExam");
  };

  var inputScore = () => {
    new page("inputScore");
  };

  return {
    account: account,
    allExam: allExam,
    myExam: myExam,
    createExam: createExam,
    inputScore: inputScore
  }
})();
