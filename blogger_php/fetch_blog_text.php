<?php
//error_reporting(0);
session_start();
if(isset($_SESSION['USER'])){
$connection = new mysqli('localhost',"root","","web_dev_project");
if($connection->connect_error){
    echo "connection error" . $connection->connect_error;
}

else{
    if ($results = $connection->query("SELECT content FROM blogs WHERE blog_id = {$_POST['blog_id']};")) {
            echo $results->fetch_assoc()['content'];
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