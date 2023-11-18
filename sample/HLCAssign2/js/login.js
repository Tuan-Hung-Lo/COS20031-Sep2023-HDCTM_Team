function validate() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    var errMsg = "";
    var result = true;

    /* Check if all required inputs have value */
    if (email == "") {
        errMsg += "Please enter your email.\n";
    }
    if (password == "") {
        errMsg += "Please enter your password.\n";
    }

    /* Check if the user ID contains an @ symbol  */
    if (email.indexOf('@') == 0) {
        errMsg += "Email cannot start with an @ symbol.\n";
    }
    if (email.indexOf('@') < 0) {
        errMsg += "Email must contain an @ symbol.\n";
    }

    /* Display error message any error(s) is/are detected */
    if (errMsg != "") {
        alert(errMsg);
        result = false;
    }
    return result;
}

function init() {
    var regForm = document.getElementById("loginform");
    regForm.onsubmit = validate;
}

window.onload = init;