<?php
//error_reporting(0);
session_start();
if (isset($_SESSION['USER'])) {
    $connection = new mysqli('localhost', "root", "", "web_dev_project");
    if ($connection->connect_error) {
        echo "connection error" . $connection->connect_error;
    } else {
        if ($result = $connection->query("SELECT name FROM users WHERE email = '{$_SESSION['USER']}';")) {
            //echo 'Inserted';
            $sr = 1;
            if (mysqli_num_rows($result)!=0) {
                while ($row = $result->fetch_assoc()) {
                            echo $row['name'];
                }
            } else {
                echo "Not Found";
            }
        } 
        else {
            echo 'Something Went Wrong!';
            }
        }
        $connection->close();
    }
else{
    echo "NOT LOGGED IN.";
}
?>




