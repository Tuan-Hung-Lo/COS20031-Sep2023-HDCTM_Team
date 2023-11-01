<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userRole = $_POST["userRole"];

    // Connect to database
    $dbHost = "your_database_host";
    $dbUser = "your_database_username";
    $dbPass = "your_database_password";
    $dbName = "your_database_name";

    $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert the user role into the UserRole table
    $stmt = $conn->prepare("INSERT INTO UserRole (UserRoleName) VALUES (?)");
    $stmt->bind_param("s", $userRole);

    if ($stmt->execute()) {
        echo "User role '$userRole' stored in the database successfully.";
    } else {
        echo "Error storing user role: " . $stmt->error;
    }

    // Close the database connection
    $stmt->close();
    $conn->close();
} else {
    // Handle invalid requests
    echo "Invalid request.";
}
?>
