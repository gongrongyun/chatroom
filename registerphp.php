<?php
$servername = "localhost";
$username = "root";
$password = "";
try {
    $pdo = new PDO("mysql:host=$servername;dbname=chat_room",$username,$password);
}
catch(PDOException $e) {
    $data="数据库连接失败".$e->getMessage();
    header(http_response_code(500));
    die(json_encode($data));
}
session_start();


if(isset($_POST['name'])) {
    $name=$_POST['name'];
}
$psw=$_POST['psw'];
$psw_confirm=$_POST['psw_confirm'];

if ($name == "" || $psw == "" || $psw_confirm == "") {
    $data="请确认信息完整性";
    header(http_response_code(401));
    die(json_encode($data));
}
else {
    $sql = "SELECT * FROM USER_INFOR_TABLE WHERE name = '$name'";
    $res=$pdo->prepare($sql);
    // $res->bindValue('id',$name);
    $res->execute();
    $result=$res->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $data="用户名已存在";
        header(http_response_code(422));
        die(json_encode($data));
    }
    else {
        // if($psw_confirm == $psw)
        // {
        $sql = "INSERT INTO USER_INFOR_TABLE (`name`, `pwd`)
        VALUES ('$name','$psw')";
        $pdo->exec($sql);
        echo json_encode("注册成功");
        $_SESSION['name']=$name;

        // }
        // else {
        //     header(http_response_code(422));
        //     $data="两次输入密码不一致";
        // }
    }
}
// echo $data;
 ?>
