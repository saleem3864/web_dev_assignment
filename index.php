<?php
session_start();
if(!isset($_SESSION['USER'])){
  
}
else{
    //header('Location:blogger_user');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ASSIGNEMENT WEB DEV</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="./common_js/common.js"></script>
</head>
<body onload='timer();'>
<div class="w3-modal" style='display:block;'>


<h3 class="w3-center">WEB DEVELOPMENT ASSIGNMENT</h3>
<h5 class="w3-center">2K18/CSM/72 - MUHAMMAD SALEEM</h5>
<div class="w3-center" id="timer">Loading...</div>
<HR></HR>
  <div class="w3-modal-content w3-card-4 w3-round w3-margin-bottom">
    <header class="w3-container w3-teal"> 
      <h2 style="text-align: center;">Sign In/UP</h2>
    </header>
    <div class="w3-container" id="reply-header">
      <p id="login-error">Your account will be created or signed in to previous one. (Name is not required for Sign In)</p>
      <label for="email" class="w3-text-blue"> Email Add.:</label>
      <input class="w3-input w3-border w3-round w3-hover-border-green w3-focus-border-green" name="email" type="email" id="email" placeholder="Your Email."/>
      <label for="topic" class="w3-text-blue"> Name:</label>
      <input class="w3-input w3-border w3-round w3-hover-border-green w3-focus-border-green" name="topic" type="text" id="name" placeholder="Your Name."/>
      <label for="topic" class="w3-text-blue"> passowrd:</label>
      <input class="w3-input w3-border w3-round w3-hover-border-green w3-focus-border-green" name="password" type="password" id="password" placeholder="Your Password."/>
      <!-- <div id = 'resolved-checkbox-div'><input class="w3-check w3-border w3-round w3-hover-border-green w3-focus-border-green w3-margin-top w3-margin-bottom" type="checkbox" onchange='validate_proceed();' id="resolved_checkbox" checked='checked' value=" RESOLVED?"> <span class='w3-wide' style='font-weight:bold;'> RESOLVED?</span></input></div> -->
      <hr/>
      <footer class="w3-container w3-margin" style="text-align: center;" id="login-footer">
    <button class="w3-button w3-round w3-green model-button" id="update-button" type="button" onclick="sign_in('to_do_user')"><i class="fa fa-sign-in"></i> <span class='w3-wide'> Proceed to To-Do.</span> <i id="loader-update" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>
    <button class="w3-button w3-round w3-green model-button" id="update-button" type="button" onclick="sign_in('blogger_user')"><i class="fa fa-sign-in"></i> <span class='w3-wide'> Proceed to Blogger.</span> <i id="loader-update" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>    
</footer>
<div class="w3-round w3-center" style = "cursor:pointer;" id="install-button" type="button" onclick="install('to_do_user')"><i class="fa fa-database"></i> <span class='w3-wide'> Install DB.</span> <i id="loader-install" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></div>
  </div>
</div>
</div>

</body>
</html>