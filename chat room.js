$(document).ready(function(){
    $("#save").click(function(){
        $.ajax({
            type:"POST",
            url:"#",
            data:{
                name:$_SESSION['name'],
                content:$("#").val(),
                status: 0,
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
            url:"",
            data:{
                name:"",
                content:"",
                datatime:"",
            },
            dataType:"json",
            success:function(data){
                if(data.name == $_SESSION['name']){
                    $("#room").append("<span class='class2'>"+ data.content +"</span>"+":"+data.name);
                }
                else{
                    $("#room").append("<span class='class1'>"+ data.content +"</span>"+":"+data.name);
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
})