<html>

<form action="http://localhost/project/net/create.php" method="get" target="_blank">
    <input type="submit" value="Create">
</form>

<form method="post">
    <input type="submit" name="view" value="View">
</form>

<form method="post">
    DELETE ID: <input type="text" name="ID"><br>
    <input type="submit" name="delete" value="delete">
</form>

<?php
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
if (isset($_POST['view'])) {
    displayArray(display($mysqli, 1));
}
if (isset($_POST['delete'])) {
    delete($mysqli);
}
?>

</html>