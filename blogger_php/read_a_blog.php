<?php
//error_reporting(0);
session_start();
if(isset($_SESSION['USER'])){
$connection = new mysqli('localhost',"root","","web_dev_project");
if($connection->connect_error){
    echo "connection error" . $connection->connect_error;
}

else{
    //echo "INSERT IGNORE INTO blog_reads (user_id, blog_id) VALUES('{$_SESSION['USER']}','{$_POST['blog_id']}');";
    if ($connection->query("INSERT INTO blog_reads (user_id, blog_id) VALUES('{$_SESSION['USER']}','{$_POST['blog_id']}');") ) {
        if ($results = $connection->query("SELECT count(*) as all_reads FROM blog_reads WHERE blog_id = {$_POST['blog_id']};")) {
            echo $results->fetch_assoc()['all_reads'];
        }
    }
    else {
        echo "<p class='w3-text-red' style='text-align: center;'>Something Went Wrong!</p>";

    }
}
$connection->close();
}
else{
    echo "NOT LOGGED IN.";
}
?>