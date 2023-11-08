<?php
// Define sample user credentials (you should use a database in a real application)
$valid_username = "user123";
$valid_password = "password123";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the submitted username and password
    $username = $_POST["email"];
    $password = $_POST["password"];

    // Check if the credentials match
    if ($username === $valid_username && $password === $valid_password) {
        // Authentication successful
        header("Location: page.php"); // Redirect to the welcome page
        exit();
    } else {
        $error_message = "Invalid username or password";
    }
}
?>
