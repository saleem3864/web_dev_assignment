<?php
//error_reporting(0);
session_start();
if(isset($_SESSION['USER'])){
$connection = new mysqli('localhost',"root","","web_dev_project");
if($connection->connect_error){
    echo "connection error" . $connection->connect_error;
}

else{
    if ($connection->query("INSERT INTO to_do (user,data) VALUES('{$_SESSION['USER']}','{$_POST['data']}');")) {
        echo "<p class='w3-text-green' style='text-align: center;'>Task Added!</p>";
        sleep(1);
    }
    else {
        sleep(1);
        echo "<p class='w3-text-red' style='text-align: center;'>Something Went Wrong!</p>";

    }
}
$connection->close();
}
else{
    echo "NOT LOGGED IN.";
}
?>