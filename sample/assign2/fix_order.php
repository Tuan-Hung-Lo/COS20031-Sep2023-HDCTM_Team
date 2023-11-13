<?php


if (!isset($_SERVER['HTTP_REFERER'])) {
    header("location: index.php");
    exit;
}

// Passing data between php pages
session_start();

require_once("support_functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Assignment 2 - COS10026 Computing Technology Inquiry Project">
    <meta name="author" content="Lo Tuan Hung, Luong Chi Duc, Ho Thanh An, Lai Gia Khanh">
    <link href="styles/style.css" rel="stylesheet">
    <link href="styles/style2.css" rel="stylesheet">
    <link rel="icon" href="images/Logo_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Fix order</title>
</head>

<body>
    <?php include_once 'includes/header.inc'; ?>

    <div id="pmtContain">
        <form id="pmtForm" method="post" action="process_order.php" novalidate>
            <fieldset class="form_field_set">
                <legend>Your information</legend>

                <input type="text" name="Bike_Id" value="<?= $_SESSION['values']['Bike_Id'] ?>" hidden>

                <div class="inputfields">
                    <label for="fname">First Name</label>
                    <input type="text" name="First_Name" id="fname" pattern="[A-Za-z]{1,25}" placeholder="Enter your first name" value="<?= akd($_SESSION['values'], 'First_Name', "") ?>" required>
                    <p class="EM"><?= akd($_SESSION['errors'], 'First_Name', "") ?></p>
                </div>

                <div class="inputfields">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="Last_Name" id="lname" pattern="[A-Za-z]{1,25}" placeholder="Enter your last name" value="<?= akd($_SESSION['values'], 'Last_Name', "") ?>" required>
                    <p class="EM"><?= akd($_SESSION['errors'], 'Last_Name', "") ?></p>
                </div>

                <div class="inputfields">
                    <label for="email">Email</label>
                    <input type="email" name="Email_Address" id="email" placeholder="swinburneuni@gmail.com" value="<?= akd($_SESSION['values'], 'Email_Address', "") ?>" required>
                    <p class="EM"><?= akd($_SESSION['errors'], 'Email_Address', "") ?></p>
                </div>

                <div class="inputfields">
                    <label for="sname">Street Address</label>
                    <input type="text" name="Street_Name" id="sname" maxlength="40" placeholder="Your street name" value="<?= akd($_SESSION['values'], 'Street_Name', "") ?>" required>
                    <p class="EM"><?= akd($_SESSION['errors'], 'Street_Name', "") ?></p>
                </div>

                <div class="inputfields">
                    <label for="stname">Suburb/Town</label>
                    <input type="text" name="Suburb_Town" id="stname" maxlength="40" placeholder="Your suburb/town name" value="<?= akd($_SESSION['values'], 'Suburb_Town', "") ?>" required>
                    <p class="EM"><?= akd($_SESSION['errors'], 'Suburb_Town', "") ?></p>
                </div>

                <div class="inputfields select">
                    <label for="state">State</label>
                    <select name="State" id="state">
                        <option value="TAS" <?= $_SESSION['values']['State'] === 'TAS' ? 'selected' : ''; ?>>Tasmania</option>
                        <option value="NT" <?= $_SESSION['values']['State'] === 'NT' ? 'selected' : ''; ?>>Northern Territory</option>
                        <option value="ACT" <?= $_SESSION['values']['State'] === 'ACT' ? 'selected' : ''; ?>>Australian Capital Territory</option>
                        <option value="QLD" <?= $_SESSION['values']['State'] === 'QLD' ? 'selected' : ''; ?>>Queensland</option>
                        <option value="SA" <?= $_SESSION['values']['State'] === 'SA' ? 'selected' : ''; ?>>South Australia</option>
                        <option value="NSW" <?= $_SESSION['values']['State'] === 'NSW' ? 'selected' : ''; ?>>New South Wales</option>
                        <option value="VIC" <?= $_SESSION['values']['State'] === 'VIC' ? 'selected' : ''; ?>>Victoria</option>
                        <option value="WA" <?= $_SESSION['values']['State'] === 'WA' ? 'selected' : ''; ?>>Western Australia</option>
                    </select>
                    <p class="EM"><?= akd($_SESSION['errors'], 'State', "") ?></p>
                </div>

                <div class="inputfields">
                    <label for="post_code">Post code</label>
                    <input type="text" name="Post_Code" id="post_code" pattern="[0-9]{4}" placeholder="0123" value="<?= akd($_SESSION['values'], 'Post_Code', "") ?>" required>
                    <p class="EM"><?= akd($_SESSION['errors'], 'Post_Code', "") ?></p>
                </div>

                <div class="inputfields">
                    <label for="phone">Phone</label>
                    <input type="text" name="Phone_Number" id="phone" pattern="[0-9]{10}" placeholder="0123456789" value="<?= akd($_SESSION['values'], 'Phone_Number', "") ?>" required>
                    <p class="EM"><?= akd($_SESSION['errors'], 'Phone_Number', "") ?></p>
                </div>

                <div class="inputfields select">
                    <label for="contactmtd">Contact Method</label>
                    <select name="Contact_Method" id="contactmtd">
                        <option value="Phone" <?= $_SESSION['values']['Contact_Method'] === 'Phone' ? 'selected' : ''; ?>>Phone</option>
                        <option value="Email" <?= $_SESSION['values']['Contact_Method'] === 'Email' ? 'selected' : ''; ?>>Email</option>
                        <option value="Post" <?= $_SESSION['values']['Contact_Method'] === 'Post' ? 'selected' : ''; ?>>Post</option>
                    </select>
                    <p class="EM"><?= akd($_SESSION['errors'], 'Contact_Method_Id', "") ?></p>
                </div>

                <div class="inputfields select">
                    <label for="pt_opts">Driving Licence</label>
                    <select name="Lic_Id" id="pt_opts">
                        <option value="1" <?= $_SESSION['values']['Lic_Id'] === '1' ? 'selected' : ''; ?>>Learner license</option>
                        <option value="2" <?= $_SESSION['values']['Lic_Id'] === '2' ? 'selected' : ''; ?>>Provisional P1 license</option>
                        <option value="3" <?= $_SESSION['values']['Lic_Id'] === '3' ? 'selected' : ''; ?>>Provisional P2 license</option>
                        <option value="4" <?= $_SESSION['values']['Lic_Id'] === '4' ? 'selected' : ''; ?>>Full license</option>
                    </select>
                    <p class="EM"><?= akd($_SESSION['errors'], 'Lic_Id', "") ?></p>
                </div>

                <div class="inputfields">
                    <label for="bikes_quantity">Quantity</label>
                    <input type="text" inputmode="numeric" name="Quantity" id="bikes_quantity" pattern="[0-9]{2}" placeholder="1 (No more than 99)" value="<?= akd($_SESSION['values'], 'Quantity', "") ?>" required>
                    <p class="EM"><?= akd($_SESSION['errors'], 'Quantity', "") ?></p>
                </div>
            </fieldset>

            <fieldset class="form_field_set">
                <legend>Payment Details</legend>

                <div class="inputfields">
                    <label for="card">Accepted Cards</label>
                    <div class="icon-container">
                        <i class="fa fa-cc-visa"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-amex"></i>
                    </div>
                </div>

                <div class="inputfields select">
                    <label for="cctype">Credit Card Type</label>
                    <select name="Credit_Card_Type" id="cctype">
                        <option value="visa" selected>Visa</option>
                        <option value="masterCard">Mastercard</option>
                        <option value="americanExpress">American Express</option>
                    </select>
                </div>

                <div class="inputfields">
                    <label for="cname">Card Name</label>
                    <input type="text" name="Card_Name" id="cname" placeholder="Name">
                    <p class="EM"><?= akd($_SESSION['errors'], 'Card_Name', "") ?></p>
                </div>

                <div class="inputfields">
                    <label for="cnumber">Credit Card Number</label>
                    <input type="text" name="Card_Number" id="cnumber" placeholder="1111-2222-3333-4444">
                    <p class="EM"><?= akd($_SESSION['errors'], 'Card_Number', "") ?></p>
                </div>

                <div class="inputfields select">
                    <label for="expired_month">Expiry Month</label>
                    <select name="Expired_Month" id="expired_month">
                        <option value="01">January</option>
                        <option value="02">February</option>
                        <option value="03">March</option>
                        <option value="04">April</option>
                        <option value="05">May</option>
                        <option value="06">June</option>
                        <option value="07">July</option>
                        <option value="08">August</option>
                        <option value="09">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                    <p class="errMsg"><?= akd($_SESSION['errors'], 'Expired_Month', "") ?></p>
                </div>

                <div class="inputfields select">
                    <label for="expired_year">Expiry Year</label>
                    <select name="Expired_Year" id="expired_year">
                        <option value="23" selected>23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">26</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                    <p class="errMsg"><?= akd($_SESSION['errors'], 'Expired_Year', "") ?></p>
                </div>

                <div class="inputfields">
                    <label for="cvv">CVV</label>
                    <input type="text" id="CVV" name="Card_Verification_Value" pattern="[0-9]{3}" placeholder="029" value="<?= akd($_SESSION['values'], 'Card_Verification_Value', "") ?>">
                    <p class="EM"><?= akd($_SESSION['errors'], 'Card_Verification_Value', "") ?></p>
                </div>

                <div class="subbtn">
                    <input type="submit" value="Check out">
                </div>
            </fieldset>
        </form>
    </div>

    <?php include_once 'includes/footer.inc'; ?>
</body>

</html>