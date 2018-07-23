$(document).ready(function(){

    function htmlspecialchars(str){            
        str = str.replace(/&/g, '&amp;');  
        str = str.replace(/</g, '&lt;');  
        str = str.replace(/>/g, '&gt;');  
        str = str.replace(/"/g, '&quot;');  
        str = str.replace(/'/g, '&#039;');  
        return str;  
    }
    var cookie_name = "name" + "=";
    var ca = document.cookie.split(";");
    for(var i = 0; i < ca.length; i++){
        var c = ca[i].trim();
        if(c.indexOf(cookie_name) == 0){
            var username = c.substring(cookie_name.length,c.length);
        }
        else {
            var username = undefined;
        }
    }

    $(document).keydown(function(event){
        if(event.keyCode == 13){
            $("#save").click();
        }
    })
    
    $("#save").click(function(){
        if(!username){
            alert("请先登录");
        }
        else if(!$("#input").val()){
            alert("聊天信息不能为空");
        }
        else {
            var mydate = new Date();
            $.ajax({
                type:"POST",
                url:"conn_chatroom.php",
                data:{
                    name : username,
                    content : $("#input").val(),
                    time : mydate.toLocaleDateString(),
                },
                dataType:"text",
                success:function(){
                },
                error:function(jqXHR){
                    console.log("error:" + jqXHR.status);
                }
            });
        }
        
        $("#input").val("");
        $("#input").focus();
    })
    var id = 0;
    setInterval(function(){
        $.ajax({
            type:"GET",
            url:"response.php",
            data:{
                name:"",
                content:"",
                time:"",
                last_id:id,
            },
            dataType:"json",
            success:function(data){
                for(var i = 0; i < data.length; i++){
                    if(data[i].name === username){
                        $("#room").append("<div class='class2'>" + htmlspecialchars(data[i].content) + "</div>");
                    }
                    else{
                        $("#room").append("<div class='class1'>" + data[i].name + ":" + htmlspecialchars(data[i].content) + "</div>" + "<br/>");
                    }
                    id = data[data.length-1].last_id;
                    var scrollDiv = $("#room");
                    scrollDiv.scrollTop(scrollDiv[0].scrollHeight);
                }
                // setInterval(function(){
                //     $("#room").append("<div class='class3'>"+data[0].time+"</div>" + "<br/>")
                // },10*60*1000);
                
            },
            error:function(jqXHR){
                console.log("error:" + jqXHR.status);
            },
        });
    },500);


    // $.ajax({
    //     type:"GET",
    //     url:"loginphp.php",
    //     data:{
    //         session_name:"",
    //     },
    //     datatype:"json",
    //     success:function(data){
    //         $("#session_name").val() = data.session_name;

    //     },
    //     error:function(jqXHR){
    //         console.log("error：" + jqXHR.status);
    //     },
    // });

    $("#submit").click(function(){//背景图还没有解决
        var formData = new FormData();
        formdata.append("name",document.getElementById("bgpic").files[0]);
        $.ajax({
            type:"POST",
            url:"picture.php",
            contentType: false,
            processData: false,
            data:formdata,
            dataType:"json",
            success:function(data){
                $("#room").css("background-image",data.name);
                console.log(data.name);
            },
            error:function(jqXHR){
                console.log("error:" + jqXHR.status);
            },
        });
    });
    $("#color").click(function(){
         $(".class2").css("background-color",$("#buble").val());
    })

});
