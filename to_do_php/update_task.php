<?php
//error_reporting(0);
session_start();
if(isset($_SESSION['USER'])){
$connection = new mysqli('localhost',"root","","web_dev_project");
if($connection->connect_error){
    echo "connection error" . $connection->connect_error;
}
else{
    if(isset($_POST['status'])){
        $sql = "UPDATE to_do SET status = '{$_POST['status']}' WHERE task_id = '{$_POST['task_id']}' AND user = '{$_SESSION['USER']}';";
    }
    else{
        $sql = "UPDATE to_do SET data = '{$_POST['data']}' WHERE task_id = '{$_POST['task_id']}' AND user = '{$_SESSION['USER']}';";
    }
    if ($connection->query($sql)) {
        echo "<p class='w3-text-green' style='text-align: center;'>Task Updated!</p>";
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