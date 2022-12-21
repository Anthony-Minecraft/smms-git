function checkInput() {
    const passInput = document.getElementById("CreatePassword").value;
    const passVerify = document.getElementById("VerifyPassword").value;
    if (passInput !== passVerify) {
      document.getElementById("VerifyPassword").classList.add("errorInput");
      document.getElementById("CreateSubmit").classList.add("errorInput");
      document.getElementById("CreateSubmit").disabled = true;
    } else {
      document.getElementById("VerifyPassword").classList.remove("errorInput");
      document.getElementById("CreateSubmit").classList.remove("errorInput");
      document.getElementById("CreateSubmit").disabled = false;
    }
}

function giveErrorMessage() {
    //check for an error
    const params = parseURLParams(window.location.href);
    if (params != null) {
      const errorElement = document.getElementById("error");
      if (params.error == "incorrect") {
        errorElement.innerHTML = "<h1 style='text-align: center;'>Incorrect Username or Password</h1>";
        const errorList = document.getElementsByClassName("login-input");
        for (i = 0; 0 < errorList.length; i++) {
          errorList[i].classList.add("errorInput");
        }
      } else if (params.error == "no_login") {
        errorElement.innerHTML = "<h1 style='text-align: center;'>Not Logged In</h1>";
      } else {
        errorElement.remove();
      }
      //pass in the url for re-routing
      if (params.url != null) {
        document.getElementById("URLInput").setAttribute("value", params.url);
      }
    }
}