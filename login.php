<?php
    // Include settings and database connection
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    session_start();
    require_once("./settings.php");

    // Checking if the manager log in name and password match one in the user table
    if (isset($_POST["email"]) && isset($_POST['password'])) {
        $email = sanitize_input($_POST["email"]);
        $password = sanitize_input($_POST["password"]);

        $user_query= "SELECT * FROM s104181721_db.UserAuthentication WHERE UserEmail = '$email' AND UserPassword = '$password';";
        $result = $conn->query($user_query);

        // The system will return to the log in page if there is no user
        if ($result->num_rows == 0) {
            header("Location: ./login.html?error_msg=AccessDenied");
        } else {
            // Fetch user details
            $user = $result->fetch_assoc();

            // Check UserRole
            $userRole = $user['UserRole'];

            // Redirect based on UserRole
            switch ($userRole) {
                case 'Job Seeker':
                    $redirectPage = "jobseeker.php";
                    // Set session variables
                    $_SESSION['job_seeker_ID'] = $user['UserAuthenticationID'];
                    $_SESSION['js_email'] = $email;
                    break;
                case 'Recruiter':
                    $redirectPage = "recruiter.php";
                    // Set session variables
                    $_SESSION['recruiter_ID'] = $user['UserAuthenticationID'];
                    $_SESSION['re_email'] = $email;
                    break;
            }


            // Redirect to the appropriate page
            header("Location: ./$redirectPage");
        }
    }
?>
