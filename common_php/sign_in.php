<?php
$connection = new mysqli('localhost', "root", "", "web_dev_project");
if ($connection->connect_error) {
    echo "connection error" . $connection->connect_error;
} else {
if ($result = $connection->query("SELECT password FROM users WHERE email = '{$_POST['email']}';")) {
            //echo 'Inserted';
    if (mysqli_num_rows($result)!=0) {
        while ($row = $result->fetch_assoc()) {
            if(password_verify($_POST['password'],$row['password'])){
                session_start();
                $_SESSION['USER'] = $_POST['email'];
                echo "PASSED IT!";   
                }
            else{
            echo 'failed';
            }       
        }
                
        } 
        else {
            if ($_POST['name'] != "") {
                if ($connection->query("INSERT INTO users (email,name,password) VALUES('{$_POST['email']}','{$_POST['name']}','".password_hash($_POST['password'], PASSWORD_BCRYPT)."');")) {
                    session_start();
                    $_SESSION['USER'] = $_POST['email'];
                    echo "PASSED IT!";
                } else {
                    echo 'failed';
                }
            }
            else{
                echo 'failed';
            }
        }
    } 
    else {
        echo "<h3 class='w3-text-red' style='text-align: center;'>Something Went Wrong!</h3>";
        }
    }
    $connection->close();
?>