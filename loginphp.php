<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";

    $name=$_POST['name'];
    $psw=$_POST['psw'];

    $data=0;


if ($name == "" || $psw == "") {
    $data="请确认信息完整性";
}
else {
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=chat_room",$username,$password);
        $sql = "SELECT * FROM USER_INFOR_TABLE WHERE name = '$name'";
        $res=$pdo->prepare($sql);
        // $res->bindValue('id',$name);
        $res->execute();
        $result=$res->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            if ($psw==$result['password']) {
                $data="登录成功";
                $_SESSION['name']=$name;
            }
            else {
                $data="用户名不存在";
            }
        } catch (PDOException $e) {
            $data="数据库连接失败".$e->getMessage();
        }
    }
    echo $data;
 ?>
