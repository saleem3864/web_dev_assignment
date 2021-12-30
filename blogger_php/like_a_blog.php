<?php
//error_reporting(0);
session_start();
if (isset($_SESSION['USER'])) {
    $connection = new mysqli('localhost', "root", "", "web_dev_project");
    if ($connection->connect_error) {
        echo "connection error" . $connection->connect_error;
    }
    else {
        if($_POST['like_type'] == 'like' || $_POST['like_type'] == 'dislike'){
            if ($connection->query("INSERT INTO likes (user_id,blog_id,like_type) values('{$_SESSION['USER']}','{$_POST['blog_id']}','{$_POST['like_type']}')")) {
                
                if ($result = $connection->query("SELECT count(*) as likes, (SELECT title FROM blogs WHERE blog_id = '{$_POST['blog_id']}') as title FROM likes WHERE blog_id = '{$_POST['blog_id']}' AND like_type = '{$_POST['like_type']}';")) {
                    $row = $result->fetch_assoc();
                    if($_POST['like_type'] == 'like'){
                        
                        echo "<div class='w3-row'><div class='w3-half'><span class ='w3-button w3-hover-pale-yellow w3-round-xlarge' onclick=\"multipurpose_model({$_POST['blog_id']},'likes','".strval($row['title'])."');\">{$row['likes']}</span></div><div class='w3-half w3-round w3-border w3-border-black w3-hover-light-blue' onclick=like_blog('{$_POST['blog_id']}','un-like','like_button');><i class='fa fa-thumbs-up w3-text-green' style='font-size: 30px;'></i></div></div>";
                        exit();
                    }
                    echo "<div class='w3-row'><div class='w3-half'><span class ='w3-button w3-hover-pale-yellow w3-round-xlarge' onclick=\"multipurpose_model({$_POST['blog_id']},'dislikes','".strval($row['title'])."');\">{$row['likes']}</span></div><div class='w3-half w3-round w3-border w3-border-black w3-hover-light-blue' onclick=like_blog('{$_POST['blog_id']}','un-dislike','dislike_button');><i class='fa fa-thumbs-down w3-text-red' style='font-size: 30px;'></i></div></div>";
                    exit();
                }
                
                //echo "<div class = 'w3-quarter w3-center w3-button' id = like_{$row['blog_id']}><div class='w3-row'><div class='w3-half'><span class ='w3-button'>{$row['likes']}</span></div><div class='w3-half w3-round w3-border w3-border-green w3-hover-light-blue' onclick=like_blog('{$row['blog_id']}');><i class='fa fa-thumbs-up' style='font-size: 30px;'></i></div></div></div>";
                
            }
            else {
                echo "<h3 class='w3-text-red' style='text-align: center;'>ERROR!</h3>";
                }
            }
            elseif($_POST['like_type'] == 'un-dislike' || $_POST['like_type'] == 'un-like'){
                if ($connection->query("DELETE FROM likes WHERE user_id = '{$_SESSION['USER']}' AND blog_id = '{$_POST['blog_id']}' AND like_type = '".substr($_POST['like_type'],3)."';")) {
                    if ($result = $connection->query("SELECT count(*) as likes, (SELECT title FROM blogs WHERE blog_id = '{$_POST['blog_id']}') as title FROM likes WHERE blog_id = '{$_POST['blog_id']}' AND like_type = '".substr($_POST['like_type'],3)."';")) {
                        $row = $result->fetch_assoc();
                        if($_POST['like_type'] == 'un-like'){
                            echo "<div class='w3-row'><div class='w3-half'><span class ='w3-button w3-hover-pale-yellow w3-round-xlarge' onclick=\"multipurpose_model({$_POST['blog_id']},'likes','".strval($row['title'])."');\">{$row['likes']}</span></div><div class='w3-half w3-round w3-border w3-border-green w3-hover-light-blue' onclick=like_blog('{$_POST['blog_id']}','like','like_button');><i class='fa fa-thumbs-up' style='font-size: 30px;'></i></div></div>";
                            exit();
                        }
                        echo "<div class='w3-row'><div class='w3-half'><span class ='w3-button w3-hover-pale-yellow w3-round-xlarge' onclick=\"multipurpose_model({$_POST['blog_id']},'dislikes','".strval($row['title'])."');\">{$row['likes']}</span></div><div class='w3-half w3-round w3-border w3-border-red w3-hover-light-blue' onclick=like_blog('{$_POST['blog_id']}','dislike','dislike_button');><i class='fa fa-thumbs-down' style='font-size: 30px;'></i></div></div>";
                        exit();
                    }                    
                }
                else {
                    echo "<h3 class='w3-text-red' style='text-align: center;'>ERROR!</h3>";
                    }
                }
            }
        $connection->close();
    }
else{
    echo "NOT LOGGED IN.";
}
?>




