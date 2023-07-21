<html>

<form method="post">
    Name: <input type="text" name="name"><br>
    Mobile Number: <input type="text" name="num"><br>
    Email: <input type="text" name="email"><br>
    Address: <input type="text" name="address"><br>
    login: <input type="text" name="login"><br>
    pwd: <input type="text" name="pwd"><br>
    <input type="submit" name="submit">
</form>

<?php
    include('functions.php');
    error_reporting(E_ALL);
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "amogh";
    $mysqli = new mysqli($servername, $username, $password, $dbname);

    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    } 
    create($mysqli);
?>

</html>