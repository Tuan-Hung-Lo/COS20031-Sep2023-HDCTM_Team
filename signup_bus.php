<?php
    // Include settings and database connection
    require_once("./settings.php");
    
    // Get form data
    $company_name = $_POST['company_name'];
    $address = $_POST['address'];
    $contact_number = $_POST['contact_number'];
    $industry = $_POST['industry'];
    $website_url = $_POST['website_url'];

    // Hash the password using the password_hash function
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

    // Insert data into tables
    $sql1 = "INSERT INTO s104181721_db.Users (FirstName, LastName)
        VALUES ('$first_name', '$first_name')";
    $conn->query($sql1);

    $sql2 = "INSERT INTO s104181721_db.UserAuthentication (UserEmail, UserPassword)
        VALUES ('$email', '$hashed_password')";
    $conn->query($sql2);

    $sql3 = "INSERT INTO s104181721_db.UserRole (UserRoleName)
        VALUES ('Bus')";
    $conn->query($sql3);

    // Get the UserAuthenticationID after inserting data into UserAuthentication table
    $UserAuthenticationID = $conn->insert_id;

    // Store data in the session
    $_SESSION['user_data'] = array(
        'UserAuthenticationID' => $UserAuthenticationID,
        'UserEmail' => $email,
        'UserPassword' => $hashed_password
    );
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="description" content="COS20031 Computing Technology Design Project">
  <meta name="author" content="Lo Tuan Hung, Luong Chi Duc, Nguyen Vu Duy Minh, Hau Linh Chi, Dao Khanh Nga Thi">
  <link href="styles/style.css" rel="stylesheet">
  <link href="styles/hehe.css" rel="stylesheet">
  <link rel="icon" href="images/Favicon-02.png" type="image/x-icon">
  <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
  <script src="https://kit.fontawesome.com/f73039f1ad.js" crossorigin="anonymous"></script>
  <title>Website title appeared on the tab</title>
</head>

<body>
    <div class="si-content">

        <div class="si-form-box">
            <img alt="Logo" src="images/Logo.png" class="logo">
            <h1>Welcome!</h1>
            <div class="si-button-box">
                <div id="su-btn"></div>
                <button type="button" class="si-toggle-btn" onclick="location.href='login.html'">Sign In</button>
                <button type="button" class="si-toggle-btn" onclick="location.href='signup_role.html'">Sign Up</button>
            </div>
            <form class="inputgr" id="si-inputgr" action="signup_bus.php" method="post">
                <div class="si-input-box">
                    <span class="si-input-icon"><img src="icons/PersonSmall.svg"></span>
                    <input name="company_name" type="text" class="si-input" placeholder="Company Name" required> 
                </div>
                <div class="si-input-box">
                    <span class="si-input-icon"><img src="icons/LocationL.svg"></span>
                    <input name="address" type="text" class="si-input" placeholder="Address" required> 
                </div>
                <div class="si-input-box">
                    <span class="si-input-icon"><img src="icons/PhoneL.svg"></span>
                    <input name="contact_number" type="text" class="si-input" placeholder="Contact Number" required> 
                </div>
                <div class="si-input-box">
                    <span class="si-input-icon"><img src="icons/Industry.svg"></span>
                    <input name="industry" type="text" class="si-input" placeholder="Industry" required> 
                </div>
                <div class="si-input-box">
                    <span class="si-input-icon"><img src="icons/Link.svg"></span>
                    <input name="website_url" type="text" class="si-input" placeholder="Website URL (Optional)"> 
                </div>
                <div class="si-submit-box">
                    <button type="submit" class="si-submit-btn">Log in</button>
                </div>
            </form>
        </div>

        <div class="si-image">
            <img alt="Background.png" src="images/sign_background.jpg">
        </div>

    </div>
</body>

</html>