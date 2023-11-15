<?php
    $host = "feenix-mariadb.swin.edu.au";
    $username = "s104181721";
    $password = "Bo0147";
    $database = "s104181721_db";

    // Create a database connection
    $conn = @mysqli_connect($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>