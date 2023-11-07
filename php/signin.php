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
    } else {
        echo('Connected');
        return $conn;
    }

    $email = $_POST["email"];
    $pwd = $_POST["password"];

    // Hash the password using the password_hash function
    $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

    $user_query= "SELECT * FROM s104222248_db.UserAuthentication
        WHERE UserEmail = '$email' AND UserPassword = '$hashed_password';";
    $result = $conn->query($user_query);

    echo('Connected');

    if ($result->num_rows == 0) {
        header("Location: ../signup_role.html");
    } else {
        header("Location: ../page.html");
    }
?>