<?php
//链接数据库
$db_pass="";
try{
    $conn=new PDO('mysql:host=127.0.0.1;dbname=chat_room','root',$db_pass);
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
// 存入聊天数据
if(isset($_POST['name'])&&isset($_POST['content'])&&isset($_POST['time'])){
  $name = $_POST['name'];
  $content = $_POST['content'];
  $time = $_POST['time'];
  $insert = $con->prepare('INSERT INTO chat_room_table (name,content,time) VALUES (:name,:content,:time)');
        $insert -> bindValue(':name',$name);
        $insert -> bindValue(':content',$content);
        $insert -> bindValue(':time',$time);
        $insert -> execute();
        echo "success";
  // $message=array();
  // $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  // $conn->bindValue("name:",name);
  // $sql="INSERT INTO chat_room_table (name,content,status) VALUES ('$name','$content',$status)";
  // $conn->exec($sql);
}
?>
