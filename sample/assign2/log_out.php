<?php
// End the session and log the manager out of the system and return to the log in page
session_start();
$_SESSION = array();
session_destroy();

header ("Location: ./log_in.php")
?>
