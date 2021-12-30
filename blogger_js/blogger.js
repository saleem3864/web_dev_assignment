function publish_blog(blog_id){
    $(document).ready(function(){
        if($('#blog-text').val() != "" && $('#blog-title').val() != ""){
            $('#loader-publish').css({display:'inline-block'});
            $('#publish-button span').text('Publishing...');
            $('#publish-button').addClass('w3-disabled');
            $.ajax({
                url : "../blogger_php/publish_blog.php",
                type : "POST",
                data:{publish:'YES',blog_id:blog_id,content:$('#blog-text').val().replace(/'/g,"(s_q)").replace(/"/g,'(d_q)'),title:$('#blog-title').val().replace(/'/g,"(s_q)").replace(/"/g,'(d_q)')},
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
                        $('#publish-button span').text('Publish.');
                    }
                }
        });
    }
    else{
        $('#publish-error').html('<p class = w3-text-red>Please Write Something in the Title and Content Fields</p>');
    }
});
}

function load_a_blog(blog_id,title,content){
    $(document).ready(function(){
        $('#blog-title').val(title.replace(/\(s_q\)/g,"'").replace(/\(d_q\)/g,'"'));
        $('#blog-text').val(content.replace(/\(s_q\)/g,"'").replace(/\(d_q\)/g,'"'));
        $('#publish-button').attr("onclick","publish_blog("+blog_id+");");
        $('#save-button').attr("onclick","save_blog("+blog_id+");");
        document.getElementById('load-saved-model').style.display='none';

});
}

function reset_blog(){
    $(document).ready(function(){
        $('#blog-title').val('');
        $('#blog-text').val('');
        $('#publish-button').attr("onclick","publish_blog('NONE');");
        $('#save-button').attr("onclick","save_blog('NONE');");
});
}

function save_blog(blog_id){
    $(document).ready(function(){
        if($('#blog-title').val() != ""){
            $('#loader-save').css({display:'inline-block'});
            $('#save-button span').text('Saving...');
            $('#save-button').addClass('w3-disabled');
            $.ajax({
                url : "../blogger_php/publish_blog.php",
                type : "POST",
                data:{publish:'NO',blog_id:blog_id,content:$('#blog-text').val().replace(/'/g,"(s_q)").replace(/"/g,'(d_q)'),title:$('#blog-title').val().replace(/'/g,"(s_q)").replace(/"/g,'(d_q)')},
                success : function(data){
                    console.log(data);
                    if(!isNaN(parseInt(data))){
                        $('#publish-error').html("<h3 class='w3-text-green' style='text-align: center;'>Blog Saved! - ID : "+data+".</h3>");
                        $('#publish-button').attr("onclick","publish_blog("+data+");");
                        $('#save-button').attr("onclick","save_blog("+data+");");
                    }
                    else{
                        $('#save-error').html(data);
                    }
                    setTimeout(()=>{
                        $('#publish-error').html("<p>Write Title of your blog and the content and hit Publish. to publish, Save. to save and Load Saved to load, edit and publish saved blogs.</p>");
                        $('#loader-save').css({display:'none'});
                        $('#save-button').removeClass('w3-disabled');
                        $('#save-button span').text('Save.');
                    },1000);
                }
                
        });
}
else{
    $('#publish-error').html('<p class = w3-text-red>Your Blog Should atleast have a Title</p>');
}
});
}


function fetch_blogs(blog_id){
    console.log(blog_id);
    $(document).ready(function(){
        $('#blogs_div').html("<h3 class='w3-text-deep-purple' style='text-align: center;'>Loading, Please Wait... <i class='fa fa-spinner fa-pulse' style = 'font-size:40px;'></i></h3>");
        $.ajax({
            url : "../blogger_php/fetch_all.php",
            type : "POST",
            data:{blog_id:blog_id},
            success : function(data){
                    $('#blogs_div').html(data);
            }
            
    });
});
}

function read_a_blog(blog_id,is_read){
    $(document).ready(function(){
        
        $('#content'+blog_id).html("<p class='w3-text-deep-purple' style='text-align: center;'>Loading, Please Wait... <i class='fa fa-spinner fa-pulse'></i></p>");
        if(!is_read){
            $('#reads_button'+blog_id).html("<i class='fa fa-spinner fa-pulse'></i>");
            $.ajax({
                url : "../blogger_php/read_a_blog.php",
                type : "POST",
                data:{'blog_id':blog_id},
                success : function(data){
                    console.log(data);
                    $('#reads_button'+blog_id).html(data);
                }           
            });
        }
    $.ajax({
        url : "../blogger_php/fetch_blog_text.php",
        type : "POST",
        data:{'blog_id':blog_id},
        success : function(data){
            console.log(data);
            $('#content'+blog_id).html(data.replace(/\(s_q\)/g,"'").replace(/\(d_q\)/g,'"'));
        }
        
});
});
}

function like_blog(blog_id,action,button_clicked){
    $(document).ready(function(){
        $('#'+button_clicked+blog_id).html("<i class='fa fa-spinner fa-pulse'></i>");
        $.ajax({
            url : "../blogger_php/like_a_blog.php",
            type : "POST",
            data:{'blog_id':blog_id,'like_type':action},
            success : function(data){
                console.log(data);
                $('#'+button_clicked+blog_id).html(data);
            }
            
    });
});
}



function comment_a_blog(blog_id){
    $(document).ready(function(){
        $('#loader-comment').css({display:'inline-block'});
        //console.log($('#task-details').val());
        $.ajax({
            url : "../blogger_php/comment_a_blog.php",
            type : "POST",
            data:{comment:$('#comment-blog').val(),blog_id:blog_id},
            success : function(data){
                console.log(data);
                if(data == "<p class='w3-text-green' style='text-align: center;'>Comment Posted!</p>"){
                    $('#comment-error').html(data);
                    setTimeout(()=>{
                        document.getElementById('comment-model').style.display='none';
                        $('#comment'+blog_id+' div div span').html(parseInt($('#comment'+blog_id+' div div span').html())+1);
                        $('#loader-comment').css({display:'none'});
                        $('#comment-error').html("Write an Comment.");
                        $('#comment-blog').val("");
                        $('#comment-title').html("Loading...")
                        //$('#comment-error').html('Loading...');
                    },500);
                }
                else{
                    $('#comment-error').html(data);
                }
                
            }
            
    });
});
}

function share_a_blog(blog_id){
    $(document).ready(function(){
        document.getElementById('multipurpose-model').style.display='block';
        $('#multipurpose-heading').html('Share');
        $('#multipurpose-title').html('Link Will be Copied to Clipboard.');
        $('#multipurpose-div').html("<h3 class='w3-text-deep-purple' style='text-align: center;'>Copying Link, Please Wait... <i class='fa fa-spinner fa-pulse' style = 'font-size:40px;'></i></h3>");
        $.ajax({
            url : "../blogger_php/share_a_blog.php",
            type : "POST",
            data:{'blog_id':blog_id},
            success : function(data){
                console.log(data);
                //$('#multipurpose-div').html(data);
            }
    });
    navigator.clipboard.writeText(location.protocol + '//' + location.host + location.pathname+'?blog_id='+blog_id);
    setTimeout(() => {
        $('#multipurpose-div').html("<h3 class='w3-text-green' style='text-align: center;'>LINK COPIED...<i class='fa fa-smile' style = 'font-size:40px;'></i></h3>");
        $('#share'+blog_id+' div div span').html(parseInt($('#share'+blog_id+' div div span').html())+1);
        setTimeout(() => {
            document.getElementById('multipurpose-model').style.display='none';
        },1000);
    },1000);
});
}

function multipurpose_model(blog_id,purpose,title){
    $(document).ready(function(){
        document.getElementById('multipurpose-model').style.display='block';
        $('#multipurpose-heading').html(purpose.toUpperCase());
        $('#multipurpose-title').html(title.replace(/\(s_q\)/g,"'").replace(/\(d_q\)/g,'"'));
        $('#multipurpose-div').html("<h3 class='w3-text-deep-purple' style='text-align: center;'>Loading, Please Wait... <i class='fa fa-spinner fa-pulse' style = 'font-size:40px;'></i></h3>");
        $.ajax({
            url : "../blogger_php/fetch_multipurpose_data.php",
            type : "POST",
            data:{'blog_id':blog_id,'purpose':purpose},
            success : function(data){
                console.log(data);
                $('#multipurpose-div').html(data);
            }
    });
});
}
function load_saved_blogs(){
    $(document).ready(function(){
        document.getElementById('load-saved-model').style.display='block';
        $('#load-saved-div').html("<h3 class='w3-text-deep-purple' style='text-align: center;'>Loading, Please Wait... <i class='fa fa-spinner fa-pulse' style = 'font-size:40px;'></i></h3>");
        $.ajax({
            url : "../blogger_php/fetch_saved.php",
            type : "POST",
            data:{},
            success : function(data){
                console.log(data);
                $('#load-saved-div').html(data);
            }
    });
});
}

function prepare_comment_model(blog_id,title){
    console.log(title);
    document.getElementById('comment-model').style.display='block';
    $('#comment-blog').focus();
    $('#comment-title').html(title.replace(/\(s_q\)/g,"'").replace(/\(d_q\)/g,'"'));
    $('#comment-button').attr("onclick","comment_a_blog("+blog_id+");");

}