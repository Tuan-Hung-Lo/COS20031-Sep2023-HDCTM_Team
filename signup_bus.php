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