<?php
    //链接数据库
    $db_pass="";
    try{
        $conn = new PDO('mysql:host=localhost;dbname=chat_room','root',$db_pass);
        $conn->exec('SET NAMES UTF8');
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    // 存入聊天数据
    if(!empty($_POST['content'])){
        echo typeof($_POST['content']);
    }
    else {
        echo $_POST['content'];
    }
    if(isset($_POST['name'])&&isset($_POST['content'])&&isset($_POST['time'])){
    $name = $_POST['name'];
    $content = $_POST['content'];
    $time = $_POST['time'];
    $insert = $con->prepare('INSERT INTO chat_room_table (name,content,time)VALUES(:name,:content,:time)');
            $insert -> bindValue(':name',$name);
            $insert -> bindValue(':content',$content);
            $insert -> bindValue(':time',$time);
            $insert -> execute();
    // $message=array();
    // $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    // $conn->bindValue("name:",name);
    // $sql="INSERT INTO chat_room_table (name,content,status) VALUES ('$name','$content',$status)";
    // $conn->exec($sql);
    //   $data = "success";
    //   echo json_encode($data);
    }
?>
