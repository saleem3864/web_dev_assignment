<?php
//error_reporting(0);
session_start();
if(isset($_SESSION['USER'])){
$connection = new mysqli('localhost',"root","","web_dev_project");
if($connection->connect_error){
    echo "connection error" . $connection->connect_error;
}

else{
    $query = ($_POST['blog_id'] == 'NONE') ? "INSERT INTO blogs (title,content,publisher,is_public) VALUES('{$_POST['title']}','{$_POST['content']}','{$_SESSION['USER']}','{$_POST['publish']}');" : "UPDATE blogs SET title = '{$_POST['title']}', content = '{$_POST['content']}',is_public = '{$_POST['publish']}' WHERE blog_id = {$_POST['blog_id']};";
    if ($connection->query($query)) {
        echo ($_POST['publish'] == 'YES') ? "<h3 class='w3-text-green' style='text-align: center;'>Blog Published!</h3>": (($_POST['blog_id'] == 'NONE') ? $connection->insert_id: $_POST['blog_id']);
    }
    else {
        echo $query;
        echo "<h3 class='w3-text-red' style='text-align: center;'>Something Went Wrong!</h3>";

    }
}
$connection->close();
}
else{
    echo "NOT LOGGED IN.";
}
?>