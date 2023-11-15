<?php
    // Include settings and database connection
    require_once("./settings.php");

    // Checking if the manager log in name and password match one in the user table
    if (isset($_POST["email"]) && isset($_POST['password'])) {
        $email = sanitize_input($_POST["email"]);
        $password = sanitize_input($_POST["password"]);

        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $user_query= "SELECT * FROM s104181721_db.UserAuthentication WHERE UserEmail = '$email' AND UserPassword = '$hashed_password';";
        $result = $conn->query($user_query);

        // The system will return to the log in page if there is no user
        if ($result->num_rows == 0) {
            header("Location: ./login.php?error_msg=AccessDenied");
        } else {
            // Fetch user details
            $user = $result->fetch_assoc();

            // Check UserRole
            $userRole = $user['UserRole'];

            // Redirect based on UserRole
            switch ($userRole) {
                case 'Job Seeker':
                    $redirectPage = "jobseeker.php";
                    break;
                case 'Recruiter':
                    $redirectPage = "recruiter.php";
                    break;
            }

            // Set session variables
            $_SESSION['UserAuthenticationID'] = $user['UserAuthenticationID'];
            $_SESSION['user_email'] = $email;

            // Redirect to the appropriate page
            header("Location: ./$redirectPage");
        }
    }
?>
