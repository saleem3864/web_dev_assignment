<?php
//error_reporting(0);
session_start();
if(isset($_SESSION['USER'])){
$connection = new mysqli('localhost',"root","","web_dev_project");
if($connection->connect_error){
    echo "connection error" . $connection->connect_error;
}

else{
    if ($connection->query("INSERT INTO shares (user_id, blog_id) VALUES('{$_SESSION['USER']}','{$_POST['blog_id']}');")) {
        //echo "<p class='w3-text-green' style='text-align: center;'>Comment Posted!</p>";
        //sleep(1);
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