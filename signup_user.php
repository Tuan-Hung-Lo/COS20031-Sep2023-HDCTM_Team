<?php
    // Database connection parameters
    $host = "feenix-mariadb-web.swin.edu.au";
    $username = "s104222248";
    $password = "031104";
    $database = "s104222248_db";

    // Create a database connection
    $conn = new mysqli($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } else {
        return $conn;
    }

    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    // Hash the password using the password_hash function
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

    // Insert data into tables
    $sql1 = "INSERT INTO s104222248_db.Users (FirstName, LastName)
        VALUES ('$first_name', '$first_name')";
    $conn->query($sql1);

    $sql2 = "INSERT INTO s104222248_db.UserAuthentication (UserEmail, UserPassword)
        VALUES ('$email', '$hashed_password')";
    $conn->query($sql2);

    $sql3 = "INSERT INTO s104222248_db.UserRole (UserRoleName)
        VALUES ('User')";
    $conn->query($sql3);
?>