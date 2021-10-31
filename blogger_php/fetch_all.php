<?php
//error_reporting(0);
session_start();
if (isset($_SESSION['USER'])) {
    $connection = new mysqli('localhost', "root", "", "web_dev_project");
    if ($connection->connect_error) {
        echo "connection error" . $connection->connect_error;
    } else {
        if ($result = $connection->query("SELECT title,published_on,name,content,publisher FROM blogs,users WHERE publisher = email  ORDER BY published_on DESC;")) {
            //echo 'Inserted';
            $sr = 1;
            if (mysqli_num_rows($result)!=0) {
                while ($row = $result->fetch_assoc()) {
                   echo  "<div class ='w3-margin w3-border w3-round'>
                              <div class='w3-light-blue w3-padding'>
                                <h2>{$row['title']}</h2>
                                <div><h5 style='display:inline;'><i class='fa fa-user' ></i> {$row['name']} <h6 style='display:inline;'><a style='text-decoration: none;' href='mailto://{$row['publisher']}'>({$row['publisher']})</a><h6></h5></div>
                                <h6><i class='fa fa-calendar'></i> {$row['published_on']}</h6>
                              </div>
                              <div class='w3-border w3-round w3-pale-blue w3-padding' >
                                <p>{$row['content']}</p>
                                </div>
                          </div>";
                        }
                
            } else {
                echo "<h3 class='w3-text-green' style='text-align: center;white-space:pre-wrap; word-wrap:break-word;'>No Blogs Published Yet!</h3>";
            }
        } 
        else {
            echo "<h3 class='w3-text-red' style='text-align: center;'>Something Went Wrong!</h3>";
            echo "SELECT title,published_on,name,content,publisher FROM blogs,users WHERE blogs.publisher = '{$_SESSION['USER']}' and blogs.publisher = users.email  ORDER BY published_on DESC;";
            //echo "SELECT data,created_on,status FROM messages WHERE status ='not-completed' AND user = '{$_SESSION['USER']}'  ORDER BY created_on DESC;";
            }
        }
        $connection->close();
    }
else{
    echo "NOT LOGGED IN.";
}
?>




