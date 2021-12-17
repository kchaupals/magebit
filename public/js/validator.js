

const mRegex = /^[\w-\.0-9]+@{1}([\w-])+\.+[\w]{2,4}$/;

let submit = false;
checked = false;
Err = false;

function getError(text) {
  const errMsg = document.getElementById("err-msg");
  errMsg.innerHTML = text;
  document.getElementById("submit").disabled = true;
  document.getElementById("submit").classList.remove("enabled-btn");
  document.getElementById("submit").classList.add("disabled-btn");
  submit = false;
}

function remError() {
  const errMsg = document.getElementById("err-msg");
  errMsg.innerHTML = "";
  document.getElementById("submit").disabled = false;
  document.getElementById("submit").classList.add("enabled-btn");
  document.getElementById("submit").classList.remove("disabled-btn");
  submit = true;
}

function validateUserInput() {
  const userInput = document.getElementById("email").value.toLowerCase();
  if (mRegex.test(userInput) === false) {
    getError("Please enter correct mail");
  } else if (userInput.split(".")[userInput.split(".").length - 1] === "co") {
    getError("We are not accepting subscriptions from Columbia emails");
  } else {
    remError();
  }
}

function chBoxCheck(check) {
  var checkB = document.getElementById("checkbox");
  if (checkB.checked === true) {
    checked = true;
    console.log(checkB);
    if (checkB) remError();
  } else {
    checked = false;
  }
}

function validateSub() {
  const mValue = document.getElementById("email").value;
  if (mValue === "") {
    getError("Field can't be empty");
  } else if (
    checked === false &&
    document.querySelector("#checkbox:checked") == null
  ) {
    getError("You must accept terms & conditions");
    Err = true;
    return false;
  } else {
    document.getElementById("s-con").classList.add("success-c");
    document.getElementById("s-img").style.display = "block";
    document.getElementById("s-msg").classList.add("success-h");
    document.getElementById("s-info").classList.add("success-p");
    document.getElementById("sub-form").classList.add("success-f");

    return true;
  }
  Err = false;
  return false;
}
