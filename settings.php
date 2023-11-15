<?php
    $host = "feenix-mariadb.swin.edu.au";
    $user = "s104181721";
    $pwd = "Bo0147";
    $sql_db = "s104181721_db";

    // Create a database connection
    $conn = @mysqli_connect($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
?>