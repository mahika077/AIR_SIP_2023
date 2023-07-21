<?php
ini_set('session.gc_maxlifetime', 1800);
session_start();

// Check if the session has expired
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 30)) {
    // Session expired, redirect to the login page or perform logout
    session_unset(); // Clear all session variables
    session_destroy(); // Destroy the session data
    header("Location: index.php");
    exit();
}

// Update last activity time on each request
$_SESSION['LAST_ACTIVITY'] = time();

// Other PHP code follows...
include('functions.php');
$username = $_GET['login'];
$password = $_GET['pwd'];

// Perform your authentication logic
error_reporting(E_ALL);
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "amogh";
$mysqli = new mysqli($servername, $username, $password, $dbname);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
if ($username === 'admin' && $password === '1111') {
    display($mysqli, 1);
    echo 'Login successful!';
} else {
    echo json_encode(display($mysqli, 0));
}
?>