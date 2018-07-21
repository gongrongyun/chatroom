$(document).ready(function(){
    $("#save").click(function(){
        $.ajax({
            type:"POST",
            url:"conn_chatroom.php",
            data:{
                name:$_SESSION['name'],
                content:$("#input").val(),
            },
            dataType:"json",
            success:function(){
            },
            error:function(jqXHR){
                console.log("error:" + jqXHR.status);
            }
        });
    })
    setInterval(function(){
        $.ajax({
            type:"GET",
            url:"response.php",
            data:{
                name:"",
                content:"",
                datatime:"",
            },
            dataType:"json",
            success:function(data){
                if(data.name === document.getElementById("session_name").value){
                    $("#room").append("<span class='class2'>"+ data.content +":"+data.name+"</span>");
                }
                else{
                    $("#room").append("<span class='class1'>"+ data.name+":"+data.content +"</span>");
                }
                setInterval(function(){
                    $("#room").append("<span class='class3'>"+data.datetime+"<span>")
                },10*60*1000);
            },
            error:function(jqXHR){
                console.log("error:" + jqXHR.status);
            }
        });
    },500);
    $.ajax({
        type:"GET",
        url:"loginphp.php",
        data:{
            session_name:"",
        },
        datatype:"json",
        success:function(data){
            $("#session_name").val() = data.name;
        },
        error:function(jqXHR){
            console.log("error：" + jqXHR.status);
        }
    })
})