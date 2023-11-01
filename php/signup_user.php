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
    }

    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Insert data into the Users table
    $sql1 = "INSERT INTO Users (FirstName, LastName) VALUES ('$first_name', '$last_name')";

    if ($conn->query($sql1) === TRUE) {
        echo "Record in Users table inserted successfully.";
    } else {
        echo "Error: " . $sql1 . "<br>" . $conn->error;
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert data into the UserAuthentication table (assuming unique email)
    $sql2 = "INSERT INTO UserAuthentication (UserEmail, UserPassword) VALUES ('$email', '$hashed_password')";

    if ($conn->query($sql2) === TRUE) {
        echo "Record in UserAuthentication table inserted successfully.";
    } else {
        echo "Error: " . $sql2 . "<br>" . $conn->error;
    }

    // Insert data into the UserRole table
    $sql3 = "INSERT INTO UserRole (UserRoleName) VALUES ('user')";

    if ($conn->query($sql3) === TRUE) {
        echo "Record in UserRole table inserted successfully.";
    } else {
        echo "Error: " . $sql3 . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
?>
