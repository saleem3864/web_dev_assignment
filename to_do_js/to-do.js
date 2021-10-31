function create_task(){
    $(document).ready(function(){
        $('#loader-done').css({display:'inline-block'});
        console.log($('#task-details').val());
        $.ajax({
            url : "../to_do_php/create_task.php",
            type : "POST",
            data:{data:$('#task-details').val()},
            success : function(data){
                console.log(data);
                if(data == "<p class='w3-text-green' style='text-align: center;'>Task Added!</p>"){
                    $('#add-error').html(data);
                    setTimeout(()=>{
                        document.getElementById('add-model').style.display='none';
                        fetch_tasks();
                        $('#task-details').val('');
                        $('#add-error').html('Add a New Task');

                    },500);
                }
                else{
                    $('#add-error').html(data);
                }
                $('#loader-done').css({display:'none'});
            }
            
    });
});
}


function update_data(task_id){
    $(document).ready(function(){
        $('#loader-update').css({display:'inline-block'});
        console.log($('#task-details').val());
        $.ajax({
            url : "../to_do_php/update_task.php",
            type : "POST",
            data:{data:$('#update-details').val(),task_id:task_id},
            success : function(data){
                console.log(data);
                if(data == "<p class='w3-text-green' style='text-align: center;'>Task Updated!</p>"){
                    $('#update-error').html(data);
                    setTimeout(()=>{
                        document.getElementById('update-model').style.display='none';
                        fetch_tasks();
                        $('#loader-update').css({display:'none'});
                        $('#update-error').html('Update a Task');
                    },500);
                }
                else{
                    $('#update-error').html(data);
                }
                $('#loader-update').css({display:'none'});
            }
            
    });
});
}

function set_update_data(data,task_id){
    console.log('HERE');
    document.getElementById('update-model').style.display='block';
    $('#update-details').val(data);
    $('#update-details').focus();
    $('#update-error').html('Update Taks  (ID - <b>'+task_id+'<b>)');
    $('#update-button').attr("onclick","update_data("+task_id+");");

}

function update_status(task_id,status){
    $(document).ready(function(){
        document.getElementById('status-model').style.display='block';
        $('#status-header').html("<h3 class='w3-text-deep-purple' style='text-align: center;'>Loading, Please Wait... <i class='fa fa-spinner fa-pulse'></i></h3>");
        $.ajax({
            url : "../to_do_php/update_task.php",
            type : "POST",
            data:{status:status,task_id:task_id},
            success : function(data){
                console.log(data);
                if(data == "<p class='w3-text-green' style='text-align: center;'>Task Updated!</p>"){
                    $('#status-header').html(data);
                    setTimeout(()=>{
                        document.getElementById('status-model').style.display='none';
                        fetch_tasks();
                    },500);
                }
                else{
                    $('#status-header').html(data);
                }
            }
            
    });
});
}

function fetch_tasks(){
    $(document).ready(function(){
        $('#tasks-div').html("<h3 class='w3-text-deep-purple' style='text-align: center;'>Loading, Please Wait... <i class='fa fa-spinner fa-pulse'></i></h3>");
        $.ajax({
            url : "../to_do_php/fetch_all.php",
            type : "POST",
            data:{},
            success : function(data){
                    $('#tasks-div').html(data);
                    console.log(data);
            }
            
    });
});
}