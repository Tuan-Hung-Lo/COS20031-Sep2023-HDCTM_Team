<?php
    // Include settings and database connection
    require_once("./settings.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve the submitted email and password
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Prepare a SQL statement with a parameterized query
        $user_query = "SELECT * FROM s104181721_db.UserAuthentication WHERE UserEmail = ?";
        $stmt = $conn->prepare($user_query);

        // Check if the statement is prepared successfully
        if ($stmt) {
            // Bind the parameter and execute the statement
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $user = $result->fetch_assoc();

                // Verify the hashed password
                if (password_verify($password, $user['UserPassword'])) {
                    // Regenerate the session ID
                    session_start();
                    session_regenerate_id(true);

                    $_SESSION['UserAuthenticationID'] = $user['UserAuthenticationID'];
                    $_SESSION['UserEmail'] = $user['UserEmail'];

                    // Redirect to a different page based on user role or application logic
                    header("Location: ./page.html");
                    exit();
                }
            }

            // Handle the case where the user ID couldn't be retrieved or password doesn't match
            header("Location: ./login.html?error=1");
            exit();
        } else {
            // Handle the case where the statement preparation failed
            header("Location: ./login.html?error=2");
            exit();
        }
    }
?>
