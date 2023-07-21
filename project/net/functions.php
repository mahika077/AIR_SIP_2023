<?php
    function displayArray($techarray){
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>name</th>";
        echo "<th>mobile_number</th>";
        echo "<th>email</th>";
        echo "<th>address</th>";
        echo "<th>login_name</th>";
        echo "<th>pwd</th>";
        echo "<th>dt_creation</th>";
        echo "<th>ID</th>";
        echo "</tr>";
        foreach($techarray as $row){
            echo "<tr>";
            echo "<td>".$row["name"]."</td>";
            echo "<td>".$row["mobile_number"]."</td>";
            echo "<td>".$row["email"]."</td>";
            echo "<td>".$row["address"]."</td>";
            echo "<td>".$row["login_name"]."</td>";
            echo "<td>".$row["pwd"]."</td>";
            echo "<td>".$row["dt_creation"]."</td>";
            echo "<td>".$row["ID"]."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    function create($mysqli){
        if(isset($_POST['submit'])) {

            $getName = $_POST['name'];
            $getNum = $_POST['num'];
            $getemail = $_POST['email'];
            $getaddress = $_POST['address'];
            $getlogin = $_POST['login'];
            $getpwd = $_POST['pwd'];
            $getdate = date("Y-m-d H:i:s");
            $query = "INSERT INTO hr(name, mobile_number, email, address, login_name, pwd, dt_creation) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
            if ($mysqli->execute_query($query, [$getName, $getNum, $getemail, $getaddress, $getlogin, $getpwd, $getdate]) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $query . "<br>" . $mysqli->error;
            }
    
            $mysqli->close();
        }
    }

    function display($mysqli, $access_level){
        if($access_level == 1){
            $query = "SELECT * FROM hr WHERE login_name = 'admin' AND pwd = '1111'";
            $result = $mysqli->query($query);
            $techarray = array();
            while($row =mysqli_fetch_assoc($result)){
                $techarray[] = $row;
            }
            return $techarray;
        }
        else{
            $getlogin = $_GET['login'];
            $getpwd = $_GET['pwd'];
            $query = "SELECT * FROM hr WHERE login_name = ? AND pwd = ?";
            $result = $mysqli->execute_query($query, [$getlogin, $getpwd]);
            if($result->num_rows != 0){
                if($getlogin != "admin" and $getpwd != "1111"){
                    $techarray = array();
                    while($row =mysqli_fetch_assoc($result)){
                        $techarray[] = $row;
                    }
                    $fp = fopen('data.json', 'w');
                    fwrite($fp, json_encode($techarray));
                    fclose($fp);
                    return $techarray;
                }
                else{
                    header("Location: http://localhost/project/admin.php");
                }
            }
            else{
                echo "asda  Invalid login credentials";
            }
            
            $mysqli->close();
        }
    }

    function delete($mysqli){
        $getID = $_POST['ID'];
        $query = "DELETE FROM hr WHERE ID = ?";
        if ($mysqli->execute_query($query, [$getID]) === TRUE) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $mysqli->error;
        }

        $mysqli->close();
    }
    
?>