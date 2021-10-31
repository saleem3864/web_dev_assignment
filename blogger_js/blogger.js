function publish_blog(){
    $(document).ready(function(){
        $('#loader-publish').css({display:'inline-block'});
        $('#publish-button span').text('Publishing...');
        $('#publish-button').addClass('w3-disabled');
        $.ajax({
            url : "../blogger_php/publish_blog.php",
            type : "POST",
            data:{content:$('#blog-text').val(),title:$('#blog-title').val()},
            success : function(data){
                console.log(data);
                if(data == "<h3 class='w3-text-green' style='text-align: center;'>Blog Published!</h3>"){
                    $('#publish-error').html(data);
                    setTimeout(()=>{
                        document.location.reload();

                    },500);
                }
                else{
                    $('#publish-error').html(data);
                    $('#loader-publish').css({display:'none'});
                    $('#publish-button').removeClass('w3-disabled');
                    $('#publish-button span').text('Publish');
                }
                
            }
            
    });
});
}


function fetch_blogs(){
    $(document).ready(function(){
        $('#blogs_div').html("<h3 class='w3-text-deep-purple' style='text-align: center;'>Loading, Please Wait... <i class='fa fa-spinner fa-pulse'></i></h3>");
        $.ajax({
            url : "../blogger_php/fetch_all.php",
            type : "POST",
            data:{},
            success : function(data){
                    $('#blogs_div').html(data);
            }
            
    });
});
}
