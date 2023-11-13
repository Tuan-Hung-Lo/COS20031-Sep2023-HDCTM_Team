<?php
// Passing the data between php pages
session_start();
?>

<?php
    require_once("./support_functions.php");

    // If the users data table does not exist, the system will create one

    try {                
        if ($conn->query('select * from s104181721_db.users limit 1') == false) {
            // Go to the catch block which contains the creation query
            throw new Exception();
        }
    } catch (Exception $e) {
        $query = "CREATE TABLE s104181721_db.users (
            user_id int(10) AUTO_INCREMENT,
            managerName varchar(50) NOT NULL,
            managerPassword varchar(50) NOT NULL
        )";
}

    // Checking if the manager log in name and password match one in the user table
    if (isset($_POST["managerName"]) && isset($_POST['managerPassword'])) {
        $username = sanitise_input($_POST["managerName"]);
        $password = sanitise_input($_POST["managerPassword"]);

        $user_query= "SELECT * FROM s104181721_db.users WHERE managerName = '$username' AND managerPassword = '$password';";
        $result = $conn->query($user_query);
        
        // The system will return to the log in page if there is no iser
        if ($result->num_rows == 0) {
            header("Location: ./log_in.php?error_msg=AccessDenied");
        } else {
            // if there is, redirect to manager page
            $_SESSION["authenticated"]=true;
            header("Location: ./manager.php");
        }
    }
?>
