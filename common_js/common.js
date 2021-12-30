function timer(){
    var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    var days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    var d = new Date();
    var day = days[d.getDay()];
    var hr = d.getHours();
    var min = d.getMinutes();
    var sec = d.getSeconds();
    if (sec < 10) {
        sec = "0" + sec;
    }
    if (min < 10) {
        min = "0" + min;
    }
    var ampm = " AM";
    if( hr > 12 ) {
        hr -= 12;
        ampm = " PM";
    }
    if (hr < 10) {
        hr = "0" + hr;
    }
    if (hr == 0) {
        hr = 12;
    }
    var date = d.getDate();
    var month = months[d.getMonth()];
    var year = d.getFullYear();
    document.getElementById('timer').innerHTML =  "<h4 style='display:inline-block;'>"+day+", "+date+"/"+month+"/"+year+";  </h4>" +" <b><h3 style='display:inline-block;'>"+ hr+":"+min+"</h3><h4 style='display:inline-block;'>:"+sec+" "+ampm+"</h4></b>";
    setTimeout(timer,1000);
    }

    function install(){
        $(document).ready(function(){
            $('#loader-install').css({display:'inline-block'});
            $('#install-button span').text('Installing...');
            $('#install-button').addClass('w3-disabled');
            //$('#login-footer').css({display:'none'});
            //$('#login-error').html("<h4 class='w3-text-deep-purple' style='text-align: center;'>Installing... <i class='fa fa-spinner fa-pulse'></i></h4>");
            $.ajax({
                url : "./common_php/install.php",
                type : "POST",
                data:{},
                success : function(data){
                    console.log(data);
                    if(data == 'INSTALLED'){
                        $('#loader-install').css({display:'none'});
                        $('#install-button span').text('DB INSTALLED!');
                    }
                    else{
                        $('#loader-install').css({display:'none'});
                        $('#install-button span').text('DB Installation Failed. RETRY!');
                        $('#install-button').removeClass('w3-disabled');
                    }
                    

                }
                
        });
    });
    }

    function sign_in(first_app){
        $(document).ready(function(){
            if($('#email').val() != '' && $('#password').val() != ''){
            $('#login-footer').css({display:'none'});
            $('#login-error').html("<h4 class='w3-text-deep-purple' style='text-align: center;'>Logging In, Please Wait... <i class='fa fa-spinner fa-pulse'></i></h4>");
            $.ajax({
                url : "./common_php/sign_in.php",
                type : "POST",
                data:{email:$('#email').val(),name:$('#name').val(),password:$('#password').val()},
                success : function(data){
                    console.log(data);
                    if(data == 'PASSED IT!'){
                        document.location.replace('./'+first_app);
                    }
                    else{
                        document.location.reload();
                    }
                }
                
        });
    }
    });
    }

    function sign_out(){
        $(document).ready(function(){
                $.ajax({
                url : "../common_php/sign_out.php",
                type : "POST",
                data:{},
                success : function(data){
                    console.log(data);
                    if(data == 'logged out'){
                        document.location.replace('./');
                    }
                    else{
                        document.location.reload();
                    }
                    

                }
                
        });
    });
    }

    function fetch_name(){
        $(document).ready(function(){
            $.ajax({
                url : "../common_php/fetch_name.php",
                type : "POST",
                data:{},
                success : function(data){
                    console.log(data);
                    if(data == 'Something Went Wrong!' || data == 'NOT LOGGED IN.' || data == 'Not Found'){
                        $('#name').html('_ _ _ _ _ _ _');
                    }
                    else{
                        $('#name').html(data);
                    }
                }        
        });
    });
    }