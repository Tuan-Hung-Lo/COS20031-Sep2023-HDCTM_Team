function validate() {
    var phoneno = document.getElementById("phoneno").value;
    var email = document.getElementById("email").value;
    var creditcardnumber = document.getElementById("creditcardnumber").value;
    var delivery = document.getElementById("delivery").checked;
    var pickupatstore = document.getElementById("pickupatstore").checked;
    var payonpickup = document.getElementById("payonpickup").checked;
    var payonline = document.getElementById("payonline").checked;
    var errMsg = "";
    var result = true;

    if ((delivery == "") && (pickupatstore == "")) {
        errMsg += "An order type must be selected.\n";
    }
    if (phoneno == "") {
        errMsg += "Contact number cannot be empty.\n";
    }
    if (email == "") {
        errMsg += "Email cannot be empty.\n";
    }
    if ((payonpickup == "") && (payonline == "")) {
        errMsg += "A payment method must be selected.\n";
    }
    if ((document.getElementById("visa").checked) && (creditcardnumber.length != 16)) {
        errMsg += "Visa card number has to be 16 digit.\n";
    }
    if ((document.getElementById("master").checked) && (creditcardnumber.length != 16)) {
        errMsg += "Mastercard number has to be 16 digit.\n";
    }
    if ((document.getElementById("americanexpress").checked) && (creditcardnumber.length != 15)) {
        errMsg += "American Express card number has to be 15 digit.\n";
    }
    if (errMsg != "") {
        alert(errMsg);
        result = false;
    }
    return result;
}

function show_if_checked() {
    var delivery = document.getElementById('delivery');
    var pay = document.getElementById('payonline');
    if (delivery.checked) {
        document.getElementById('ifYes').style.visibility = 'visible';
    }
    else document.getElementById('ifYes').style.visibility = 'hidden';

    if (pay.checked) {
        document.getElementById('ifyeah').style.visibility = 'visible';
    }
    else document.getElementById('ifyeah').style.visibility = 'hidden';
}

function duplicate_address() {
    var deliveryaddress = document.getElementById("deliveryaddress");
    var billingaddress = document.getElementById("billingaddress");
    if (document.getElementById("duplicate-address").checked) {
        if (deliveryaddress.value) {
            billingaddress.value = deliveryaddress.value;
        }
        else {
            alert('Please enter your delivery address first.');
        }

    }
}

function init() {
    var regForm = document.getElementById("ordform");
    regForm.onsubmit = validate;
}

function test() {
    show_if_checked();
    duplicate_address();
}

window.onload = init;
window.onchange = test;

