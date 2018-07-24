<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";

$name=$_POST['name'];
$psw=$_POST['psw'];
$psw_confirm=$_POST['psw_confirm'];

$data=0;

if ($name == "" || $psw == "" || $psw_confirm == "") {
    $data="请确认信息完整性";
    header(http_response_code(401));
    die(json_encode($data));
}
else {
    try {
        $pdo = new PDO("mysql:host=$servername;dbname=chat_room",$username,$password);
        $sql = "SELECT * FROM USER_INFOR_TABLE WHERE name = '$name'";
        $res=$pdo->prepare($sql);
        // $res->bindValue('id',$name);
        $res->execute();
        $result=$res->fetch(PDO::FETCH_ASSOC);
        $pdo=null;
        if ($result) {
            $data="用户名已存在";
            header(http_response_code(422));
            die(json_encode($data));
        }
        else {
            // if($psw_confirm == $psw)
            // {
                try {
                    $pdo = new PDO("mysql:host=$servername;dbname=chat_room",$username,$password);
                    $sql = "INSERT INTO USER_INFOR_TABLE (name,pwd)
                    VALUES ('$name','$psw')";
                    $pdo->exec($sql);
                    $data="注册成功";
                    $_SESSION['name']=$name;
                }
                catch(PDOException $e) {
                    $data="2#数据库连接失败".$e->getMessage();
                    header(http_response_code(500));
                    die(json_encode($data));
                }

            // }
            // else {
            //     header(http_response_code(422));
            //     $data="两次输入密码不一致";
            // }
            }

    } catch (PDOException $e) {
        $data="1#数据库连接失败".$e->getMessage();
        header(http_response_code(500));
        die(json_encode($data));
    }
}

echo $data;
 ?>
