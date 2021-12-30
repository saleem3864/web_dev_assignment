<?php
//error_reporting(0);
session_start();
if (isset($_SESSION['USER'])) {
    $connection = new mysqli('localhost', "root", "", "web_dev_project");
    if ($connection->connect_error) {
        echo "connection error" . $connection->connect_error;
    } else {
        if ($result = $connection->query("SELECT blog_id, title, published_on, content FROM blogs where publisher = '{$_SESSION['USER']}' AND is_public = 'NO' ORDER BY published_on DESC;")) {
            //echo 'Inserted';
            $sr = 1;
            if (mysqli_num_rows($result)!=0) {
                while ($row = $result->fetch_assoc()) {
                    echo  "<div class ='w3-padding w3-margin-bottom w3-round w3-card'>
                       <div class='w3-row' style='display:inline-block;'><h4 style = 'display:inline-block; font-size:15px;'>".str_replace('(d_q)','"',str_replace('(s_q)',"'",$row['title']))." . </h4> <h6 style = 'font-size:10px; display:inline-block;'>{$row['published_on']}</h6></div>
                       <div style='display:inline-block;' class = 'w3-right'><button class='w3-button w3-round w3-blue w3-right' id = load_button{$row['blog_id']} type='button' onclick=\"load_a_blog({$row['blog_id']},'{$row['title']}','{$row['content']}');\"><i class='fa fa-pencil'></i> <span class='w3-wide'> Load.</span> <i id='loader-load' style='text-align: right; display: none' class='w3-margin-left fa fa-spinner fa-pulse'></i></button></div>
                       </div>";
                        }
            } else {
                echo "<h3 class='w3-text-green' style='text-align: center;white-space:pre-wrap; word-wrap:break-word;'>No Saved Blogs!</h3>";
            }
        } 
        else {
            echo "<h3 class='w3-text-red' style='text-align: center;'>Something Went Wrong!</h3>";
            //echo "SELECT title,published_on,name,content,publisher, (SELECT count(*) FROM likes WHERE blog_id = blogs.blog_id AND like_type = 'like') as  likes, (SELECT count(*) FROM likes WHERE blog_id = blogs.blog_id AND like_type = 'dislike') as  dislikes, (SELECT count(*) FROM comments WHERE blog_id = blogs.blog_id) as  comments FROM blogs,users WHERE publisher = email ORDER BY published_on DESC;";
            //echo "SELECT data,created_on,status FROM messages WHERE status ='not-completed' AND user = '{$_SESSION['USER']}'  ORDER BY created_on DESC;";
            }
        }
        $connection->close();
    }
else{
    echo "NOT LOGGED IN.";
}
?>




