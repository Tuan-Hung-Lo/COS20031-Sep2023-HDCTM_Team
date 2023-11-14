<?php
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    require_once("./settings.php");

    // Create a database connection
    $conn = @mysqli_connect($host, $username, $password, $database);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the submitted email and password
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Prepare a SQL statement with a parameterized query
        $user_query = "SELECT UserID, UserPassword FROM UserAuthentication WHERE UserEmail = ? LIMIT 1";
        $stmt = $conn->prepare($user_query);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the hashed password
            if (password_verify($password, $user['UserPassword'])) {
                // Now $user['user_id'] contains the user ID
                session_start();
                $_SESSION['user_id'] = $user['UserAuthenticationID'];
                $_SESSION['user_email'] = $user['UserEmail'];

                header("Location: ../page.html");
                exit();
            }
        }

        // Handle the case where the user ID couldn't be retrieved or password doesn't match
        header("Location: ../signin.html");
        exit();
    }
?>
