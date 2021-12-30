<?php
//error_reporting(0);
session_start();
if (isset($_SESSION['USER'])) {
    $connection = new mysqli('localhost', "root", "", "web_dev_project");
    if ($connection->connect_error) {
        echo "connection error" . $connection->connect_error;
    } else {
        $filter = ($_POST['blog_id'] == 0) ? '' : "AND blog_id = {$_POST['blog_id']}";
        if ($result = $connection->query("SELECT blog_id, title,published_on,name,LEFT(content,100) as content,publisher, (SELECT count(*) FROM likes WHERE blog_id = blogs.blog_id AND like_type = 'like') as  likes, (SELECT count(*) FROM likes WHERE blog_id = blogs.blog_id AND like_type = 'dislike') as  dislikes, (SELECT count(*) FROM comments WHERE blog_id = blogs.blog_id) as  comments,(SELECT count(*) FROM shares WHERE blog_id = blogs.blog_id) as  shares,(SELECT count(*) FROM blog_reads WHERE blog_id = blogs.blog_id) as blog_reads, (SELECT count(*) FROM likes WHERE blog_id = blogs.blog_id AND user_id = '{$_SESSION['USER']}' AND like_type = 'like') as is_liked, (SELECT count(*) FROM likes WHERE blog_id = blogs.blog_id AND user_id = '{$_SESSION['USER']}' AND like_type = 'dislike') as is_disliked, (SELECT count(*) FROM blog_reads WHERE blog_id = blogs.blog_id AND user_id = '{$_SESSION['USER']}') as is_read FROM blogs,users WHERE publisher = email {$filter} ORDER BY published_on DESC;")) {
            //echo 'Inserted';
            $sr = 1;
            if (mysqli_num_rows($result)!=0) {
                while ($row = $result->fetch_assoc()) {
                    //echo $row["blog_id"];
                    $like_btn = ($row['is_liked']) ? "<div class = 'w3-quarter w3-center w3-padding' id = like_button{$row['blog_id']}><div class='w3-row'><div class='w3-half'><span class ='w3-button w3-hover-pale-yellow w3-round-xlarge' onclick=\"multipurpose_model({$row['blog_id']},'likes','".strval($row['title'])."');\">{$row['likes']}</span></div><div class='w3-half w3-round w3-border w3-border-black w3-hover-light-blue' onclick=like_blog('{$row['blog_id']}','un-like','like_button');><i class='fa fa-thumbs-up w3-text-green' style='font-size: 30px;'></i></div></div></div>":"<div class = 'w3-quarter w3-center w3-padding' id = like_button{$row['blog_id']}><div class='w3-row'><div class='w3-half'><span class ='w3-button w3-hover-pale-yellow w3-round-xlarge' onclick=\"multipurpose_model({$row['blog_id']},'likes','".strval($row['title'])."');\">{$row['likes']}</span></div><div class='w3-half w3-round w3-border w3-border-green w3-hover-light-blue' onclick=like_blog('{$row['blog_id']}','like','like_button');><i class='fa fa-thumbs-up' style='font-size: 30px;'></i></div></div></div>";
                    $dislike_btn = ($row['is_disliked']) ? "<div class = 'w3-quarter w3-center w3-padding' id = dislike_button{$row['blog_id']}><div class='w3-row'><div class='w3-half'><span class ='w3-button w3-hover-pale-yellow w3-round-xlarge' onclick=\"multipurpose_model({$row['blog_id']},'dislikes','".strval($row['title'])."');\">{$row['dislikes']}</span></div><div class='w3-half w3-round w3-border w3-border-black w3-hover-light-blue' onclick=like_blog('{$row['blog_id']}','un-dislike','dislike_button');><i class='fa fa-thumbs-down w3-text-red' style='font-size: 30px;'></i></div></div></div>":"<div class = 'w3-quarter w3-center w3-padding' id = dislike_button{$row['blog_id']}><div class='w3-row'><div class='w3-half'><span class ='w3-button w3-hover-pale-yellow w3-round-xlarge' onclick=\"multipurpose_model({$row['blog_id']},'dislikes','".strval($row['title'])."');\">{$row['dislikes']}</span></div><div class='w3-half w3-round w3-border w3-border-red w3-hover-light-blue' onclick=like_blog('{$row['blog_id']}','dislike','dislike_button');><i class='fa fa-thumbs-down' style='font-size: 30px;'></i></div></div></div>";
                    echo  "<div class ='w3-margin w3-border w3-round'>
                              <div class='w3-light-blue w3-padding'>
                                <h2>".str_replace('(d_q)','"',str_replace('(s_q)',"'",$row['title']))."</h2>
                                <div><h5 style='display:inline;'><i class='fa fa-user' ></i> {$row['name']} <h6 style='display:inline;'><a style='text-decoration: none;' href='mailto://{$row['publisher']}'>({$row['publisher']})</a><h6></h5></div>
                                <h6><i class='fa fa-calendar'></i> {$row['published_on']}</h6>
                                <h6><i class='fa fa-eye'></i> <span id = reads_button{$row['blog_id']} class ='w3-button w3-hover-pale-yellow w3-round-xlarge' onclick=\"multipurpose_model({$row['blog_id']},'reads','".strval($row['title'])."');\">{$row['blog_reads']}</span></h6>
                              </div>
                              <div class='w3-border w3-round w3-pale-blue w3-padding'>
                                <p id = content{$row['blog_id']}>".str_replace('(d_q)','"',str_replace('(s_q)',"'",$row['content']))."  <u onclick = read_a_blog({$row['blog_id']},{$row['is_read']}); style = 'cursor:pointer;'>Read More...</u></p>
                                </div>
                                <div class='w3-row'>{$like_btn}{$dislike_btn}
                                    <div class = 'w3-quarter w3-center w3-padding' id = comment{$row['blog_id']}> <div class='w3-row'><div class='w3-half'><span class ='w3-button w3-hover-pale-yellow w3-round-xlarge' onclick=\"multipurpose_model({$row['blog_id']},'comments','".strval($row['title'])."');\">{$row['comments']}</span></div><div class='w3-half w3-round w3-border w3-border-blue w3-hover-light-blue' onclick=\"prepare_comment_model({$row['blog_id']},'".strval($row['title'])."');\"><i class='fa fa-comment' style='font-size: 30px;'></i></div></div></div>
                                    <div class = 'w3-quarter w3-center w3-padding' id = share{$row['blog_id']}><div class='w3-row'><div class='w3-half'><span class ='w3-button w3-hover-pale-yellow w3-round-xlarge' onclick=\"multipurpose_model({$row['blog_id']},'shares','".strval($row['title'])."');\">{$row['shares']}</span></div><div class='w3-half w3-round w3-border w3-border-amber w3-hover-light-blue' onclick=share_a_blog('{$row['blog_id']}');><i class='fa fa-share-alt-square' style='font-size: 30px;'></i></div></div></div>
                                </div>
                          </div>";
                        }
                
            } else {
                echo "<h3 class='w3-text-green' style='text-align: center;white-space:pre-wrap; word-wrap:break-word;'>No Blogs Published Yet!</h3>";
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




