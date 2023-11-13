<?php

//Deny access directly through URL - Reference: https://github.com/IrfanGhuori/block-direct-access
if (!isset($_SERVER['HTTP_REFERER'])) {
    header("location: index.php");
    exit;
}

// Pass data between PHP pages
session_start();
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
    <title>Receipt</title>
</head>

<body class="receipt_body">
<?php include 'includes/header.inc'; ?>
<div class="receipt_intro">
    <h1>
        Your payment
    </h1>
</div class="outer_receipt">
<div class="inner_receipt">
    <div class="seller_info">
        <h2>HDAK</h2>
        <p>Address: Ha Noi, Viet Nam</p>
        <p>Hotline: +84-123-456-789</p>
    </div>
    <div class="payment_user_info">
        <h3>Your information</h3>
        <div>
            <p>Name: <?php echo $_SESSION['values']['First_Name'], " ", $_SESSION['values']['Last_Name'] ?></p>
            <p>Address: <?php echo $_SESSION['values']['Street_Name'], " ", $_SESSION['values']['Suburb_Town'], " ", $_SESSION['values']['State'] ?></p>
            <p>Post code: <?php echo $_SESSION['values']['Post_Code'] ?></p>
        </div>
        <div>
            <p>Order Number: <?php echo $_SESSION['values']['ord_id'] ?></p>
            <p>Time: <?php echo $_SESSION['values']['ord_time'] ?></p>
        </div>
        <div>
            <p>Bike ID: <?php echo $_SESSION['values']['Bike_Id'] ?></p>
            <p class="pd_name">Product name: <?php echo $_SESSION['values']['Pd_Name'] ?></p>
        </div>
    </div>
    <div>
        <div>
            <h3>Order details</h3>
        </div>
        <div class="product_info">
            <div>
                <p>License</p>
                <p>Order Quantity</p>
                <p>Shipping Fee</p>
                <p>Discount</p>
                <p>Total</p>
            </div>
            <div>
                <p><?php echo $_SESSION['values']['Lic_Name'] ?></p>
                <p><?php echo $_SESSION['values']['Quantity'] ?></p>
                <p>FREE</p>
                <p>NONE</p>
                <p><?php echo $_SESSION['values']['ord_cost'] ?></p>
            </div>
        </div>
    </div>
    <div class="payment_detail">
        <h3>Payment details</h3>
        <p>Order status: <?php echo $_SESSION['values']['ord_status'] ?></p>
        <p>Credit card: <?php echo $_SESSION['values']['Credit_Card_Type'] ?></p>
        <p>Card name: <?php echo $_SESSION['values']['Card_Name'] ?></p>
        <p>Card Number: ****************</p>
        <p>Expired Date: **/**</p>
        <p>Card Verification Value: ***</p>
    </div>
    <div class="payment_detail" style="border-bottom: 1px dashed black;">
        <p>Contact details</p>
        <p>Email: <?php echo $_SESSION['values']['Email_Address'] ?></p>
        <p>Phone: <?php echo $_SESSION['values']['Phone_Number'] ?></p>
        <p>Contact Method: <?php echo $_SESSION['values']['Contact_Method'] ?></p>
    </div>
    <div class="thank_you">
        <h2>Thank you for your order</h2>
    </div>
</div>
</div>
<?php include 'includes/footer.inc'; ?>
</body>

</html>