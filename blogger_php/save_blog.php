<?php
//error_reporting(0);
session_start();
if(isset($_SESSION['USER'])){
$connection = new mysqli('localhost',"root","","web_dev_project");
if($connection->connect_error){
    echo "connection error" . $connection->connect_error;
}

else{
    if ($connection->query("INSERT INTO blogs (title,content,publisher) VALUES('{$_POST['title']}','{$_POST['content']}','{$_SESSION['USER']}');")) {
        //echo "<h3 class='w3-text-green' style='text-align: center;'>Blog Published!</h3>";
        //sleep(1);
        echo $connection->insert_id;
    }
    else {
        sleep(1);
        //echo "INSERT INTO blogs (title,content,publisher) VALUES('{$_POST['title']}','{$_POST['content']}','{$_SESSION['USER']}');";
        echo "<h3 class='w3-text-red' style='text-align: center;'>Something Went Wrong!</h3>";

    }
}
$connection->close();
}
else{
    echo "NOT LOGGED IN.";
}
?>