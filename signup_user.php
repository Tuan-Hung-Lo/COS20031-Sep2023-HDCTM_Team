<?php
    // Include settings and database connection
    require_once("./settings.php");

    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    // Hash the password using the password_hash function
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

    // Insert data into tables
    $sql1 = "INSERT INTO s104181721_db.JobSeeker (FirstName, LastName)
        VALUES ('$first_name', '$first_name')";
    $conn->query($sql1);

    $sql2 = "INSERT INTO s104181721_db.UserAuthentication (UserEmail, UserPassword, UserRole)
        VALUES ('$email', '$hashed_password', 'User')";
    $conn->query($sql2);

    // Get the UserAuthenticationID after inserting data into UserAuthentication table
    $UserAuthenticationID = $conn->insert_id;

    // Store data in the session
    $_SESSION['user_data'] = array(
        'UserAuthenticationID' => $UserAuthenticationID,
        'UserEmail' => $email,
        'UserPassword' => $hashed_password
    );
?>