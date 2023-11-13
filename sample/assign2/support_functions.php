<?php
require_once("settings.php");
// Connect to database
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);
// Check for connection errors
if ($conn->connect_error) {
    // If error exists, display an error message and terminate the program
    die("Connection failed: " . $conn->connect_error);
} else {
    // If there's no error, return the database connection object
    return $conn;
}

// Sanitizing data
function sanitise_input($data)
{
    // remove leading and trailing spaces
    $data = trim($data);
    // remove backslashes
    $data = stripcslashes($data);
    // remove HTML control characters
    $data = htmlspecialchars($data);
    return $data;
}

// Check for the data
function ndv($name, $default_value)
{
    if (isset($_GET[$name])) {
        $value = $_GET[$name];
      } else {
        $value = $default_value;
      }
    return $value;
}

// Retrieve the value from an associative array $array for the specified value $key.
function akd($array, $key, $default) //tên gốc: array_key_coalesce
{
    //Checking if the array have the specific key
    if (array_key_exists($key, $array)) {
        return $array[$key];
    } else {
        return $default;
    }
}