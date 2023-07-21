<html>

<form method="get">
    login: <input type="text" name="login"><br>
    pwd: <input type="text" name="pwd"><br>
    <input type="submit" name="submit">
</form>

<form action="http://localhost/project/net/create.php" method="get" target="_blank">
  <input type="submit" value="Sign Up">
</form>

<?php

ini_set('session.gc_maxlifetime', 10);
session_start();

// Check if the session has expired
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 10)) {
    // Session expired, redirect to the login page or perform logout
    session_unset(); // Clear all session variables
    session_destroy(); // Destroy the session data
    header("Location: index.php");
    exit();
}

// Update last activity time on each request
$_SESSION['LAST_ACTIVITY'] = time();

// Other PHP code follows...


    include('net/functions.php');
    error_reporting(E_ALL);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "amogh";
    $mysqli = new mysqli($servername, $username, $password, $dbname);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }
    if(isset($_GET['submit'])) {
        displayArray(display($mysqli, 0));
    }
?>

</html>