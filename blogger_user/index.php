<?php
session_start();
if(!isset($_SESSION['USER'])){
    header('Location:../');
}
//echo $_GET['blog_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Blogger Application</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../blogger_js/blogger.js"></script>
    <script src="../common_js/common.js"></script>

</head>

<body onload=fetch_name();fetch_blogs(<?php echo (isset($_GET['blog_id']) ? $_GET['blog_id']: 0);?>);timer();>
    <div class="w3-contaner">
        <h1 class="w3-center">Blogger Application</h1>
        <div class="w3-center" id="timer">Loading...</div>
        <footer class="w3-container w3-margin" style="text-align: right;" id="login-footer">
          <button class="w3-button w3-round w3-teal model-button"  type="button" onclick="document.location.replace('../to_do_user')"><i class="fa fa-tasks"></i> <span class='w3-wide'> Switch to To-Do.</span> <i id="loader-update" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>
          <button class="w3-button w3-round w3-red model-button" type="button" onclick="sign_out()"><i class="fa fa-sign-out"></i> <span class='w3-wide'> Signout.</span> <i id="loader-update" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>    
      </footer>
            <div class="w3-container w3-round">
                <div style="width: 100%; margin-left: 0%; margin-right: 2%;" class="w3-card">
                    <div class="w3-teal">
                        <table class="w3-table">
                            <tr>
                                <td style="vertical-align: middle;">
                                    <div class=" w3-padding" style="text-align: start; display: table-cell;">Welcome <b id ='name'>Loading... <i style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></b></div>
                                </td>
                                <td>
                                    <!-- <div class="" style="text-align: end;"><button  onclick="sign_out();" class="w3-btn w3-black"><i class="fa fa-sign-out"></i></button></div>
                     -->
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id=publish_blog class="w3-card w3-margin-top w3-grey w3-margin"> 
                    <div class="w3-container" id="reply-header">
                        <div class="w3-blue-grey w3-center"><h3 style='display:inline;'>Write and <h1 style='display:inline;'>Publish</h1> a Blog</h3></div>
                        <div id=publish-error><p>Write Title of your blog and the content and hit Publish. to publish, Save. to save and Load Saved to load, edit and publish saved blogs.</p></div>
                        <label for="topic" class="w3-text-blue w3-left"> Blog Topic:</label>
                        <input class="w3-input w3-border w3-round w3-hover-border-green w3-focus-border-green" name="topic" type="text" id="blog-title" placeholder="Topic Of Your Blog."/>
                        <label for="task-details" class="w3-text-blue w3-left"> Whats In Your Mind?:</label>
                        <textarea id="blog-text" class="w3-input w3-border w3-round w3-hover-border-green w3-focus-border-green" name="body-email" type="text" placeholder="Write What Ever You Want to Publish (5000 Characters Max) - HTML SUPPORTED." style="height: 150px;"></textarea>
                        <button class="w3-button w3-round w3-yellow model-button w3-margin-top w3-margin-bottom w3-left" id="publish-button" type="button" onclick=publish_blog('NONE');><i class="fa fa-paper-plane"></i> <span class='w3-wide'> Publish.</span> <i id="loader-publish" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>
                        <button class="w3-button w3-round w3-green model-button w3-margin-top w3-margin-left w3-margin-bottom w3-left" id="save-button" type="button" onclick=save_blog('NONE');><i class="fa fa-save"></i> <span class='w3-wide'> Save.</span> <i id="loader-save" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>
                        <button class="w3-button w3-round w3-red model-button w3-margin-top w3-margin-left w3-margin-bottom w3-left" id="reset-button" type="button" onclick=reset_blog();><i class="fa fa-undo"></i> <span class='w3-wide'> Reset.</span> <i id="loader-save" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>
                        <button class="w3-button w3-round w3-blue model-button w3-margin-top w3-margin-left w3-margin-bottom w3-right" id="load-button" type="button" onclick=load_saved_blogs();><i class="fa fa-list-alt"></i> <span class='w3-wide'> Load Saved.</span> <i id="loader-load" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>
                      </div>
                    </div>
                    <hr/>
                    <div class="w3-card w3-margin"> 
                    <div class="w3-container" id="reply-header">
                        <div class="w3-orange w3-center"><h3 style='display:inline;'>The <h1 style='display:inline;'>Blog</h1> spot</h3></div>
                        <div id= blogs_div>
                        </div>  
                      </div>
                    </div>
                </div>
                
            </div>
    </div>
    <div id="comment-model" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-round w3-margin-bottom">
            <header class="w3-container w3-teal"> 
            <span onclick="document.getElementById('comment-model').style.display='none'" 
            class="w3-button w3-display-topright"><i class="fa fa-times"></i></span>
            <h2 style="text-align: center;">Comment Blog</h2>
            </header>
            <div class="w3-container" id="reply-header">
                <h3 id = "comment-title">Loading...</h3>
                <p id="comment-error">Write an Comment.</p>
                <label for="comment-blog" class="w3-text-blue"> Comment:</label>
                <textarea id="comment-blog" class="w3-input w3-border w3-round w3-hover-border-green w3-focus-border-green" name="body-email" type="text" placeholder="Write Details Of Task. (1000 Characters Max)" style="height: 100px;"></textarea>
                </div>
                <footer class="w3-container w3-margin" style="text-align: center;">
                <button class="w3-button w3-round w3-green model-button w3-margin" id="comment-button" type="button" onclick='comment_a_blog();'><i class="fa fa-check"></i> <span class='w3-wide'> COMMENT.</span> <i id="loader-comment" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>
            
            </footer>
            </div>
        </div>
    </div>
    <div id="multipurpose-model" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-round w3-margin-bottom">
            <header class="w3-container w3-teal"> 
            <span onclick="document.getElementById('multipurpose-model').style.display='none'" 
            class="w3-button w3-display-topright"><i class="fa fa-times"></i></span>
            <h2 style="text-align: center;" id = 'multipurpose-heading'>Loading...</h2>
            </header>
            <h3 id = "multipurpose-title" style="text-align: center;">LOADING</h3>
            <hr class='w3-yellow'/>
            <div class="w3-container" id="multipurpose-div">
                
            </div>
            </div>
        </div>
    </div>
    <div id="load-saved-model" class="w3-modal">
        <div class="w3-modal-content w3-card-4 w3-round w3-margin-bottom">
            <header class="w3-container w3-teal"> 
            <span onclick="document.getElementById('load-saved-model').style.display='none'" 
            class="w3-button w3-display-topright"><i class="fa fa-times"></i></span>
            <h2 style="text-align: center;">Load Saved Blogs</h2>
            </header>
            <div class="w3-container w3-padding" id="load-saved-div">
                
            </div>
            </div>
        </div>
    </div>

</body>
</html>