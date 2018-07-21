<?php
//链接数据库
$db_pass="";
try{
    $conn=new PDO('mysql:host=127.0.0.1;dbname=chat_room','root',$db_pass);
} catch(PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
// 存入聊天数据
if(isset($_POST['name'])&&isset($_POST['content'])){
  $name=$_POST['name'];
  $content=$_POST['content'];
  $status=$_POST['status'];
  $insert = $con->prepare('INSERT INTO chat_room_table (name,connent,status)VALUES(:name,:connent,:status)');
        $insert -> bindValue(':name',$name);
        $insert -> bindValue(':connent',$connent);
        $insert -> bindValue(':status'$status,);
        $insert -> execute();
  // $message=array();
  // $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  // $conn->bindValue("name:",name);
  // $sql="INSERT INTO chat_room_table (name,content,status) VALUES ('$name','$content',$status)";
  // $conn->exec($sql);
}
?>
