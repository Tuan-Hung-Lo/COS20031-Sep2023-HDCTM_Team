function validate() {
    var email = document.getElementById("email").value;
    var name = document.getElementById("name").value;
    var password = document.getElementById("password").value;
    var passwordretype = document.getElementById("passwordretype").value;
    var username = document.getElementById("username").value;
    var genm = document.getElementById("genm").checked;
    var genf = document.getElementById("genf").checked;
    var genno = document.getElementById("genno").checked;

    var errMsg = "";
    var result = true;

    /* Check if all required inputs have value */
    if (name == "") {
        errMsg += "Please enter your name.\n";
    }
    if ((genm == "") && (genf == "") && (genno == "")) {
        errMsg += "Please select an option for gender.\n";
    }
    if (username == "") {
        errMsg += "Please enter your username.\n";
    }
    if (email == "") {
        errMsg += "Please enter your email.\n";
    }
    if (password == "") {
        errMsg += "Please enter your password.\n";
    }
    if (passwordretype == "") {
        errMsg += "Please retype your password.\n";
    }

    /* Check if the user ID contains an @ symbol  */
    if (email.indexOf('@') == 0) {
        errMsg += "Email cannot start with an @ symbol.\n";
    }
    if (email.indexOf('@') < 0) {
        errMsg += "Email must contain an @ symbol.\n";
    }

    /* Check if password and retype password are the same */
    if (password != passwordretype) {
        errMsg += "Passwords do not match.\n";
    }

    /* Display error message any error(s) is/are detected */
    if (errMsg != "") {
        alert(errMsg);
        result = false;
    }
    return result;
}

function init() {
    var regForm = document.getElementById("regform");
    regForm.onsubmit = validate;
}

window.onload = init;