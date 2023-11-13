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
    <title>Payment</title>
</head>

<body>
    <?php include_once 'includes/header.inc'; ?>

    <div id="pmtContain">
        <form id="pmtForm" method="post" action="process_order.php" novalidate>
            <fieldset class="form_field_set">
                <legend>Your information</legend>

                <input type="text" name="Bike_Id" value="<?= $_GET['Bike_Id'] ?>" hidden>

                <div class="inputfields">
                    <label for="fname">First Name</label>
                    <input type="text" name="First_Name" id="fname" pattern="[A-Za-z]{1,25}" placeholder="Enter your first name" required>
                </div>

                <div class="inputfields">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="Last_Name" id="lname" pattern="[A-Za-z]{1,25}" placeholder="Enter your last name" required>
                </div>

                <div class="inputfields">
                    <label for="email">Email</label>
                    <input type="email" name="Email_Address" id="email" placeholder="swinburneuni@gmail.com" required>
                </div>

                <div class="inputfields">
                    <label for="sname">Street Address</label>
                    <input type="text" name="Street_Name" id="sname" maxlength="40" placeholder="Your street name" required>
                </div>

                <div class="inputfields">
                    <label for="stname">Suburb/Town</label>
                    <input type="text" name="Suburb_Town" id="stname" maxlength="40" placeholder="Your suburb/town name" required>
                </div>

                <div class="inputfields select">
                    <label for="state">State</label>
                    <select name="State" id="state">
                        <option value="TAS" selected>Tasmania</option>
                        <option value="NT">Northern Territory</option>
                        <option value="ACT">Australian Capital Territory</option>
                        <option value="QLD">Queensland</option>
                        <option value="SA">South Australia</option>
                        <option value="NSW">New South Wales</option>
                        <option value="VIC">Victoria</option>
                        <option value="WA">Western Australia</option>
                    </select>
                </div>

                <div class="inputfields">
                    <label for="post_code">Post code</label>
                    <input type="text" name="Post_Code" id="post_code" pattern="[0-9]{4}" placeholder="0123" required>
                </div>

                <div class="inputfields">
                    <label for="phone">Phone</label>
                    <input type="text" name="Phone_Number" id="phone" pattern="[0-9]{10}" placeholder="0123456789" required>
                </div>

                <div class="inputfields select">
                    <label for="contactmtd">Contact Method</label>
                    <select name="Contact_Method" id="contactmtd">
                        <option value="Phone" selected>Phone</option>
                        <option value="Email">Email</option>
                        <option value="Post">Post</option>
                    </select>
                </div>

                <div class="inputfields select">
                    <label for="pt_opts">Driving Licence</label>
                    <select name="Lic_Id" id="pt_opts">
                        <option value="1" selected>Learner license</option>
                        <option value="2">Provisional P1 license</option>
                        <option value="3">Provisional P2 license</option>
                        <option value="4">Full license</option>
                    </select>
                </div>

                <div class="inputfields">
                    <label for="bikes_quantity">Quantity</label>
                    <input type="text" inputmode="numeric" name="Quantity" id="bikes_quantity" pattern="[0-9]{2}" placeholder="1 (No more than 99)" required>
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
                </div>

                <div class="inputfields">
                    <label for="cnumber">Credit Card Number</label>
                    <input type="text" name="Card_Number" id="cnumber" placeholder="1111-2222-3333-4444">
                </div>

                <div class="inputfields select">
                    <label for="expired_month">Expiry Month</label>
                    <select name="Expired_Month" id="expired_month">
                        <option value="01" selected>January</option>
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
                </div>

                <div class="inputfields select">
                    <label for="expired_year">Expiry Year</label>
                    <select name="Expired_Year" id="expired_year">
                        <option value="23" selected>23</option>
                        <option value="24">24</option>
                        <option value="25">25</option>
                        <option value="26">26</option>
                        <option value="27">27</option>
                        <option value="28">28</option>
                        <option value="29">29</option>
                        <option value="30">30</option>
                        <option value="31">31</option>
                    </select>
                </div>

                <div class="inputfields">
                    <label for="cvv">Card Verification Value</label>
                    <input type="text" id="CVV" name="Card_Verification_Value" pattern="[0-9]{3}" placeholder="029">
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