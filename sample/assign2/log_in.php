<?php


// Checking if the user has Log in
session_start();
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
    header("Location: ./manager.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="description" content="Assignment 2 - COS10026 Computing Technology Inquiry Project">
    <meta name="author" content="Lo Tuan Hung, Luong Chi Duc, Ho Thanh An, Lai Gia Khanh">
    <link href="styles/style.css" rel="stylesheet">
    <link href="styles/style2.css" rel="stylesheet">
    <link rel="icon" href="images/Logo_icon.png" type="image/x-icon">
    <title>Login</title>
</head>

<body>
    <?php include_once 'includes/header.inc'; ?>
    <div id="login">
        <!-- Creating log in form-->
        <form action="authentication.php" method="post" id="loginForm">
            <fieldset>
                <legend>Manager Login</legend>
                <div class="formElement">
                    <label for="managerName">Username: </label>
                    <input type="text" name="managerName" id="managerName" pattern="[A-Za-z0-9]{1,25}" placeholder="Enter your management name" required>
                </div>
                <div class="formElement">
                    <label for="managerPassword">Password: </label>
                    <input type="text" name="managerPassword" id="managerPassword" pattern="[A-Za-z0-9]{1,25}" placeholder="Enter your management password" required>
                </div>
                <input type="submit" value="login">
                <?php
                if (isset($_GET["error_msg"])) {
                    if ($_GET["error_msg"] == "AccessDenied") {
                        echo "<h3 id=loginError>Invalid username or password. Please try again</h3>";
                    } else if ($_GET["error_msg"] == "Unauthenticated") {
                        echo "<h3 id=loginError>Please login to access the manager page</h3>";
                    }
                }
                ?>
            </fieldset>
        </form>
    </div>

    <?php include_once 'includes/footer.inc'; ?>
</body>

</html>