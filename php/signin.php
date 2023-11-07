<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

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

    $email = $_POST["email"];
    $pwd = $_POST["password"];

    // Hash the password using the password_hash function
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

    $user_query= "SELECT * FROM s104222248_db.UserAuthentication
        WHERE UserEmail = '$email' AND UserPassword = '$hashed_password';";
    $result = $conn->query($user_query);

    if ($result->num_rows == 0) {
        header("Location: ../signin.html");
    } else {
        $user = $result->fetch_assoc();
        // Verify the hashed password
        if (password_verify($pwd, $user['UserPassword'])) {
            header("Location: ../page.html");
        } else {
            header("Location: ../signin.html");
        }
    }
?>