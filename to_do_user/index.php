<?php
session_start();
if(!isset($_SESSION['USER'])){
    header('Location:../');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>To-Do Application</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="../to_do_js/to-do.js"></script>
    <script src="../common_js/common.js"></script>

</head>
<body onload='fetch_name();fetch_tasks();timer();'>
    <div class="w3-contaner">
        <h1 class="w3-center">To-Do Application</h1>
        <div class="w3-center" id="timer">Loading...</div>
        <footer class="w3-container w3-margin" style="text-align: right;" id="login-footer">
          <button class="w3-button w3-round w3-teal model-button" type="button" onclick="document.location.replace('../blogger_user')"><i class="fa fa-rss"></i> <span class='w3-wide'> Switch to Blogger.</span> <i style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>
          <button class="w3-button w3-round w3-red model-button" type="button" onclick="sign_out()"><i class="fa fa-sign-out"></i> <span class='w3-wide'> Signout.</span> <i style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>    
      </footer>
            <div class="w3-container  w3-center w3-round">
                <div style="width: 100%; margin-left: 0%; margin-right: 2%;" class="w3-card">
                    <div class="w3-teal">
                        <table class="w3-table">
                            <tr>
                                <td style="vertical-align: middle;">
                                    <div class="" style="text-align: start; display: table-cell;">Welcome <b id ='name'>Loading... <i style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></b></div>
                                </td>
                                <td>
                                    <div class="" style="text-align: end;"><button  onclick="document.getElementById('add-model').style.display='block'" class="w3-btn w3-black"><i class="fa fa-plus"></i></button></div>
                    
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div id=tasks-div>
                        <h3 class='w3-text-deep-purple' style='text-align: center;'>Loading, Please Wait... <i class='fa fa-spinner fa-pulse'></i></h3>
                    </div>
                </div>
                
            </div>
    </div>


    
<div id="add-model" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-round w3-margin-bottom">
    <header class="w3-container w3-teal"> 
      <span onclick="document.getElementById('add-model').style.display='none'" 
      class="w3-button w3-display-topright"><i class="fa fa-times"></i></span>
      <h2 style="text-align: center;">New Task.</h2>
    </header>
    <div class="w3-container" id="reply-header">
      <p id="add-error">Add a new Task</p>
      <label for="task-details" class="w3-text-blue"> Task Details:</label>
      <textarea id="task-details" class="w3-input w3-border w3-round w3-hover-border-green w3-focus-border-green" name="body-email" type="text" placeholder="Write Details Of Task. (1000 Characters Max)" style="height: 100px;"></textarea>
      </div>
    <footer class="w3-container" style="text-align: center;">
    <button class="w3-button w3-round w3-green w3-margin" id="proceed-button" type="button" onclick='create_task();'><i class="fa fa-check"></i> <span class='w3-wide'> Done.</span> <i id="loader-done" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>
    </footer>
  </div>
</div>
</div>


<div id="update-model" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-round w3-margin-bottom">
    <header class="w3-container w3-teal"> 
      <span onclick="document.getElementById('update-model').style.display='none'" 
      class="w3-button w3-display-topright"><i class="fa fa-times"></i></span>
      <h2 style="text-align: center;">Update a Task.</h2>
    </header>
    <div class="w3-container" id="reply-header">
      <p id="update-error">Update Task Task</p>
      <label for="update-details" class="w3-text-blue"> Update Task Details:</label>
      <textarea id="update-details" class="w3-input w3-border w3-round w3-hover-border-green w3-focus-border-green" name="body-email" type="text" placeholder="Write Details Of Task. (1000 Characters Max)" style="height: 100px;"></textarea>
      </div>
      <footer class="w3-container" style="text-align: center;">
    <button class="w3-button w3-round w3-green w3-margin" id="update-button" type="button" onclick=''><i class="fa fa-check"></i> <span class='w3-wide'> Update.</span> <i id="loader-update" style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></button>
    </footer>
  </div>
</div>
</div>
<div id="status-model" class="w3-modal">
  <div class="w3-modal-content w3-card-4 w3-round w3-margin-bottom">
    <header class="w3-container w3-teal"> 
      <span onclick="document.getElementById('status-model').style.display='none'" 
      class="w3-button w3-display-topright"><i class="fa fa-times"></i></span>
      <h2 style="text-align: center;">Update Task Status.</h2>
    </header>
    <div class="w3-container" id="status-header">
    <p class='w3-text-green' style='text-align: center;'>Updating Status.... <i style="text-align: right; display: none" class=" w3-margin-left fa fa-spinner fa-pulse"></i></p>
  </div>
</div>
</div>
</body>
</html>