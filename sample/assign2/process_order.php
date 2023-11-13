-/<?php

//Deny access directly through URL - Reference: https://github.com/IrfanGhuori/block-direct-access
if (!isset($_SERVER['HTTP_REFERER'])) {
    header("location: index.php");
    exit;
}

// Pass data between PHP pages
session_start();
?>

<?php
require_once("support_functions.php");

// If table doesn't already exists, create it
try {
    // Check if a table exists by selecting from it
    if ($conn->query('select * from s104181721_db.orders') == false) {
        throw new Exception();
    }
    // Catch block which contains the creation query
} catch (Exception $exception) {
    $query = "CREATE TABLE s104181721_db.orders (
        -- Order details
        ord_id int(6) AUTO_INCREMENT,
        ord_time timestamp default current_timestamp,
        ord_status varchar(255) DEFAULT 'PENDING',
        ord_cost int(25) NOT NULL,
        
        -- Personal details
        First_Name varchar(25) NOT NULL,
        Last_Name varchar(25) NOT NULL,
        Email_Address varchar(100) NOT NULL,
        Phone_Number int(10) NOT NULL,
        Contact_Method varchar(50) NOT NULL,
        
        -- Address details
        Street_Name varchar(40) NOT NULL,
        Suburb_Town varchar(40) NOT NULL,
        State varchar(40) NOT NULL,
        Post_Code int(4) NOT NULL,

        -- Number of products ordered
        Quantity int(2) NOT NULL,
        
        -- Card details
        Credit_Card_Type varchar(50) NOT NULL,
        Card_Name varchar(50) NOT NULL,
        Card_Number varchar(16) NOT NULL,
        Expired_Date char(5) NOT NULL,
        Card_Verification_Value int(3) NOT NULL,

        -- Foreign Keys to respective tables
        Bike_Id int NOT NULL,
        Lic_Id int NOT NULL,
        Lic_Name varchar(50) NOT NULL,
        
        FOREIGN KEY (Bike_Id) REFERENCES products(Bike_Id),
        FOREIGN KEY (Lic_Id) REFERENCES license(Lic_Id),
        FOREIGN KEY (ord_id) REFERENCES customers(ord_id),
        PRIMARY KEY (ord_id)
     )";

    $conn->query($query);
}

// SELECT the last inserted order
$query = "SELECT ord_id, ord_time, ord_status FROM s104181721_db.orders";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Output data of the row
    while($row = $result->fetch_assoc()) {
        $ord_id = $row["ord_id"];
        $ord_time = $row["ord_time"];
        $ord_status = $row["ord_status"];
    }
}

// Create an array that stores errors for each form field
$errors = array();

// First Name input validation
if (isset($_POST["First_Name"]) && $_POST["First_Name"] != "") {
    $First_Name = sanitise_input($_POST["First_Name"]);
    if (!preg_match("/^[a-zA-Z]*$/", $First_Name)) {
        $errors["First_Name"] = "Only alpha letters are allowed in your first name (no spaces).";
    } else if (strlen($First_Name) > 25) {
        $errors["First_Name"] = "First Name should not be more than 25 characters.";
    }
} else {
    $errors["First_Name"] = "Please enter your First Name!";
}

// Last Name input validation
if (isset($_POST["Last_Name"]) && $_POST["Last_Name"] != "") {
    $Last_Name = sanitise_input($_POST["Last_Name"]);
    if (!preg_match("/^[a-zA-Z]*$/", $Last_Name)) {
        $errors["Last_Name"] =  "Only alpha letters are allowed in your last name (no spaces).";
    } else if (strlen($Last_Name) > 25) {
        $errors["Last_Name"] =  "Last Name should not be more than 25 characters.";
    }
} else {
    $errors["Last_Name"] = "Please enter your Last Name.";
}

// Email Address input validation
if (isset($_POST["Email_Address"])) {
    $Email_Address = sanitise_input($_POST["Email_Address"]);
    $Email_Address = filter_var($Email_Address, FILTER_SANITIZE_EMAIL); // Remove illegal characters
    if ($Email_Address == "") {
        $errors["Email_Address"] =  "Please enter your Email Address.";
    } else if ((filter_var($Email_Address, FILTER_VALIDATE_EMAIL)) == false) { // Performs validation against the Email_Address address format
        $errors["Email_Address"] =  "Invalid Email Address address.";
    }
} else {
    $errors["Email_Address"] = "Please enter your Email Address.";
}

// Street Name input validation
if (isset($_POST["Street_Name"]) && $_POST["Street_Name"] != "") {
    $Street_Name = sanitise_input($_POST["Street_Name"]);
    if (!preg_match("/^[A-Za-z0-9'\.\-\s\,\/]*$/", $Street_Name)) {
        $errors["Street_Name"] =  "Only Characters such as ['A-Z', 'a-z', '0-9', '.', '-', '/'] are allowed for Street_Name.";
    } else if (strlen($Street_Name) > 40) {
        $errors["Street_Name"] =  "Street Name should not be more than 40 characters.";
    }
} else {
    $errors["Street_Name"] = "Please enter your Street Name.";
}

// Suburb Town input validation
if (isset($_POST["Suburb_Town"]) && $_POST["Suburb_Town"] != "") {
    $Suburb_Town = sanitise_input($_POST["Suburb_Town"]);
    if (!preg_match("/^[A-Za-z0-9'\.\-\s\,\/]*$/", $Suburb_Town)) {
        $errors["Suburb_Town"] =  "Only Characters such as ['A-Z', 'a-z', '0-9', '.', '-', '/'] are allowed for Suburb_Town.";
    } else if (strlen($Suburb_Town) > 40) {
        $errors["Suburb_Town"] =  "Surburb Town should not be more than 40 characters.";
    }
} else {
    $errors["Suburb_Town"] = "Please enter your Street Name.";
}

// State input validation
if (isset($_POST["State"])) {
    $State = sanitise_input($_POST["State"]);
} else {
    $errors["State"] = "Please choose your State in the given list.";
}

// Post Code input validation
if (isset($_POST["Post_Code"]) && $_POST["Post_Code"] != "") {
    $Post_Code = sanitise_input($_POST["Post_Code"]);
    if (!preg_match("/^[0-9]*$/", $Post_Code)) {
        $errors["Post_Code"] =   "Post Code only accepts integers.";
    } else if (strlen($Post_Code) != 4) {
        $errors["Post_Code"] =  "Post Code in Australia must be 4 digits.";
    }
} else {
    $errors["Post_Code"] = "Please enter your Post Code.";
}

// Phone Number input validation
if (isset($_POST["Phone_Number"]) && $_POST["Phone_Number"] != "") {
    $Phone_Number = sanitise_input($_POST["Phone_Number"]);
    if (!preg_match("/^[0-9]*$/", $Phone_Number)) {
        $errors["Phone_Number"] = "Phone number is not a valid Phone Number.";
    } else if (strlen($Phone_Number) != 10) {
        $errors["Phone_Number"] = "Phone number must be 10 digits.";
    }
} else {
    $errors["Phone_Number"] = "Please enter your Phone Number.";
}

// Contact Method Id input validation
if (isset($_POST["Contact_Method"])) {
    $Contact_Method = sanitise_input($_POST["Contact_Method"]);
} else {
    $errors["Contact_Method"] = "Please select a Contact Method.";
}

// License Id input validation
if (isset($_POST["Lic_Id"])) {
    $Lic_Id = sanitise_input($_POST["Lic_Id"]);
} else {
    $errors["Lic_Id"] = "Please select your License.";
}

// Quantity input validation
if (isset($_POST["Quantity"]) && $_POST["Quantity"] != "") {
    $Quantity = sanitise_input($_POST["Quantity"]);
    if (!preg_match("/^[0-9]*$/", $Quantity)) {
        $errors["Quantity"] = "Product quantity only accepts integers.";
    } else if (strlen($Quantity) > 2) {
        $errors["Quantity"] =  "Sorry, we just accept maximum 99 products per order time.";
    }
} else {
    $errors["Quantity"] = "Please select the number of products.";
}

// Passed from products.php via a query parameter
$Bike_Id = sanitise_input($_POST["Bike_Id"]);

// Credit Card Type input validation
if (isset($_POST["Credit_Card_Type"])) {
    $Credit_Card_Type = sanitise_input($_POST["Credit_Card_Type"]);
} else {
    $errors["Credit_Card_Type"] = "Please select your credit card type.";
}

// Card Name input validation
if (isset($_POST["Card_Name"]) && $_POST["Card_Name"] != "") {
    $Card_Name = sanitise_input($_POST["Card_Name"]);
} else {
    $errors["Card_Name"] = "Please enter your credit card name.";
}

// Card Number input validation
if (isset($_POST["Card_Number"]) && $_POST["Card_Number"] != "") {
    $Card_Number = sanitise_input($_POST["Card_Number"]);
    $Card_Number = preg_replace('/\s+/', '', $Card_Number);
    $first_num = $Card_Number[0];
    $second_num = $Card_Number[1];
    if ($Card_Number == "") {
        $errors["Card_Number"] = "You must enter your Credit Card number.";
    } else if (!preg_match("/^[0-9]*$/", $Card_Number)) {
        $errors["Card_Number"] = "Credit Card number only accepts integers.";
    } else if ($Credit_Card_Type == "visa") {
        // Visa cards must have 16 digits and start with a "4"
        if (strlen($Card_Number) != 16) {
            $errors["Card_Number"] = "Visa card number must have 16 digits.";
        } else if ($first_num != "4") {
            $errors["Card_Number"] = "Visa card number must start with '4'.";
        }
    } else if ($Credit_Card_Type == "masterCard") {
        // MasterCard must have 16 digits and start with digits "51" through to "55"
        if (strlen($Card_Number) != 16) {
            $errors["Card_Number"] = "MasterCard number must have 16 digits.";
        } else if (($first_num != "5")) {
            $errors["Card_Number"] = "Invalid card number (must start with '51'-'55').";
        } else if (($second_num < "1" or $second_num > "5")) {
            $errors["Card_Number"] = "Invalid card number (must start with '51'-'55').";
        }
    } else if ($Credit_Card_Type == "americanExpress") {
        // American Express must have 15 digits and starts with "34" or "37"
        if (strlen($Card_Number) != 15) {
            $errors["Card_Number"] = "American Express card number must have 15 digits.";
        } else if ($first_num != "3" or ($sec_num != "4" or $second_num != "7")) {
            $errors["Card_Number"] = "Invalid card number (must start with '34' or '37').";
        }
    }
} else {
    $errors["Card_Number"] = "Please enter your credit card number.";
}

// Expiry Month input validation
if (isset($_POST["Expired_Month"]) && $_POST["Expired_Month"] != "") {
    $Expired_Month = sanitise_input($_POST["Expired_Month"]);
} else {
    $errors["Expired_Month"] = "Please enter your credit card expiry month.";
}

// Expiry Year input validation
if (isset($_POST["Expired_Year"]) && $_POST["Expired_Year"] != "") {
    $Expired_Year = sanitise_input($_POST["Expired_Year"]);
} else {
    $errors["Expired_Year"] = "Please enter your credit card expiry year.";
}

//Validate Expiry Date
if (!array_key_exists("Expired_Month", $errors) && !array_key_exists("Expired_Year", $errors)) {
    if ($Expired_Month <= date("m") && $Expired_Year <= date("y")) {
        $errors["Expired_Month"] = "Card is expired. Try another one.";
        $errors["Expired_Year"] = "Card is expired. Try another one.";
    } else {
        // Show the date in mm/yy form
        $Expired_Date = "$Expired_Month/$Expired_Year";
    }
}

// Card Verification Value input validation
if (isset($_POST["Card_Verification_Value"]) && $_POST["Card_Verification_Value"] != "") {
    $Card_Verification_Value = sanitise_input($_POST["Card_Verification_Value"]);
    if (!preg_match("/^[0-9]*$/", $Card_Verification_Value)) {
        $errors["Card_Verification_Value"] = "Credit Card CVV only accepts integers.";
    } else if (strlen($Card_Verification_Value) != 3) {
        $errors["Card_Verification_Value"] = "Card CVV must have 3 digits.";
    }
} else {
    $errors["Card_Verification_Value"] = "Please enter your credit card CVV.";
}

// Used to populate fix_order.php fields and receipt.php
$values = array(
    "ord_id" => $ord_id,
    "ord_time" => $ord_time,
    "ord_status" => $ord_status,

    "First_Name" => $First_Name,
    "Last_Name" => $Last_Name,
    "Email_Address" => $Email_Address,
    "Phone_Number" => $Phone_Number,

    "Street_Name" => $Street_Name,
    "Suburb_Town" => $Suburb_Town,
    "State" => $State,
    "Post_Code" => $Post_Code,

    "Quantity" => $Quantity,

    "Credit_Card_Type" => $Credit_Card_Type,
    "Card_Name" => $Card_Name,
    "Card_Number" => $Card_Number,
    "Expired_Date" => $Expired_Date,
    "Card_Verification_Value" => $Card_Verification_Value,

    "Contact_Method" => $Contact_Method,
    "Bike_Id" => $Bike_Id,
    "Lic_Id" => $Lic_Id,
);

$_SESSION['values'] = $values;

// If there are any errors, redirect to fix_order.php
if (!empty($errors)) {
    $_SESSION["errors"] = $errors;
    header("location: fix_order.php");
    return;
}
// Get the product name for receipt.php
$pdname = $conn->query("SELECT Pd_Name FROM s104181721_db.products WHERE Bike_Id = $Bike_Id;");
$Pdt_Name = mysqli_fetch_assoc($pdname);
$Product_Name = $Pdt_Name['Pd_Name'];

//  Get the price of the products from 'license' table
$infp = $conn->query("SELECT Pd_Price, Lic_Name FROM s104181721_db.license WHERE Lic_Id = $Lic_Id;");
$pd_infp = mysqli_fetch_assoc($infp);
$License_Name = $pd_infp['Lic_Name'];

// Change the result to integer and string
$price = intval($pd_infp['Pd_Price']);

// Calculate final cost
$ord_cost = $price * intval($Quantity);

// Input values into 'value' array
$values['ord_cost'] = $ord_cost;
$values['Pd_Name'] = $Product_Name;
$values['Lic_Name'] = $License_Name;

//  Get the name of the products from 'products' table
$infn =  $conn->query("SELECT Pd_Name FROM s104181721_db.products WHERE Bike_Id = $Bike_Id;");
$pd_infn = mysqli_fetch_assoc($infn);

$_SESSION['values'] = $values;
//Insert data into the 'order' table
$ord_table = "INSERT INTO s104181721_db.orders (ord_cost, First_Name, Last_Name, Email_Address, Phone_Number, Contact_Method, Street_Name, Suburb_Town, State, Post_Code, Bike_Id, Quantity, Lic_Id, Lic_Name, Credit_Card_Type, Card_Name, Card_Number, Expired_Date, Card_Verification_Value)
    VALUES ('$ord_cost', '$First_Name', '$Last_Name', '$Email_Address', '$Phone_Number', '$Contact_Method', '$Street_Name', '$Suburb_Town', '$State', '$Post_Code', '$Bike_Id', '$Quantity', '$Lic_Id', '$License_Name', '$Credit_Card_Type', '$Card_Name', '$Card_Number', '$Expired_Date', '$Card_Verification_Value')";
$conn->query($ord_table);

//Insert data into the 'customers' table
$cus_table = "INSERT INTO s104181721_db.customers (First_Name, Last_Name, Email_Address, Phone_Number, Contact_Method, Street_Name, Suburb_Town, State, Post_Code, Credit_Card_Type, Card_Name, Card_Number, Expired_Date, Card_Verification_Value)
    VALUES ('$First_Name', '$Last_Name', '$Email_Address', '$Phone_Number', '$Contact_Method', '$Street_Name', '$Suburb_Town', '$State', '$Post_Code', '$Credit_Card_Type', '$Card_Name', '$Card_Number', '$Expired_Date', '$Card_Verification_Value')";
$conn->query($cus_table);

header("location: receipt.php")

?>