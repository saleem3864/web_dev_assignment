<?php
//error_reporting(0);
session_start();
if (isset($_SESSION['USER'])) {
    $connection = new mysqli('localhost', "root", "", "web_dev_project");
    if ($connection->connect_error) {
        echo "connection error" . $connection->connect_error;
    } else {
        //echo substr($_POST['purpose'],0,strlen($_POST['purpose'])-1);
        if($_POST['purpose'] == 'comments'){
            if ($result = $connection->query("SELECT name, comment_time, comment FROM comments,users WHERE user_id = email AND blog_id = {$_POST['blog_id']} ORDER BY comment_time DESC;")) {
                //echo 'Inserted';
                $sr = 1;
                if (mysqli_num_rows($result)!=0) {
                    while ($row = $result->fetch_assoc()) {
                       echo  "<div class ='w3-padding w3-margin-bottom w3-round w3-card'>
                       <div class='w3-row'><h4 style = 'display:inline-block; font-size:15px;'>{$row['name']} . </h4> <h6 style = 'font-size:10px; display:inline-block;'>{$row['comment_time']}</h6></div>
                                  <div style='height:1px;' class='w3-grey'></div>
                                  <div><h4 style = 'font-size:20px;'>{$row['comment']}</h4> </div>
                              </div>";
                            }
                    
                } else {
                    echo "<h3 class='w3-text-green' style='text-align: center;white-space:pre-wrap; word-wrap:break-word;'>No Comments Yet!</h3>";
                }
            } 
            else {
                echo "<h3 class='w3-text-red' style='text-align: center;'>Something Went Wrong!</h3>";
                echo "SELECT name, commented_on, comment FROM comments,users WHERE user_id = email AND blog_id = {$_POST['blog_id']} ORDER BY commented_on DESC;";
                }
            }
        else{
            if($_POST['purpose'] == 'likes' || $_POST['purpose'] == 'dislikes'){
                $query = "SELECT name, time FROM likes,users WHERE user_id = email AND blog_id = {$_POST['blog_id']} AND like_type = '". substr($_POST['purpose'],0,strlen($_POST['purpose'])-1)."' ORDER BY time DESC;";
            }
            elseif($_POST['purpose'] == 'reads'){
                $query = "SELECT name, time FROM blog_reads,users WHERE user_id = email AND blog_id = {$_POST['blog_id']} ORDER BY time DESC;";
            }
            else{
                $query = "SELECT name, time FROM shares,users WHERE user_id = email AND blog_id = {$_POST['blog_id']} ORDER BY time DESC;";
            }
            if ($result = $connection->query($query)) {
                //echo 'Inserted';
                //$sr = 1;
                if (mysqli_num_rows($result)!=0) {
                    while ($row = $result->fetch_assoc()) {
                       echo  "<div class ='w3-padding w3-margin-bottom w3-round w3-card'>
                            <div class='w3-row'><h4 style = 'display:inline-block;'>{$row['name']} . </h4> <h6 style = 'font-size:10px; display:inline-block;'>{$row['time']}</h6></div>
                                  
                              </div>";
                            }
                } else {
                    //echo $query;
                    echo "<h3 class='w3-text-green' style='text-align: center;white-space:pre-wrap; word-wrap:break-word;'>No {$_POST['purpose']} yet!</h3>";
                }
            } 
            else {
                echo "<h3 class='w3-text-red' style='text-align: center;'>Something Went Wrong!</h3>";
                echo $query;    
            }
            }
        }
        
        $connection->close();
    }
else{
    echo "NOT LOGGED IN.";
}
?>




