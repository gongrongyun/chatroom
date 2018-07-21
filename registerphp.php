<?php
$servername = "localhost";
$username = "root";
$password = "";

$name=$_POST['name'];
$psw=$_POST['psw'];
$psw_confirm=$_POST['psw_confirm'];

// $name="wsx9721";
// $psw="123";
// $psw_confirm="1234";

$data=0;

if ($name == "" || $psw == "" || $psw_confirm == "") {
    $data="请确认信息完整性";
}
else {
    if($psw_confirm == $psw)
    {
        try {
            $conn = new PDO("mysql:host=$servername;dbname=chat_room",$username,$password);
            $sql = "INSERT INTO USER_INFOR_TABLE (name,password)
            VALUES ('$name','$psw')";
            $conn->exec($sql);
            $data="注册成功";
        }
        catch(PDOException $e)
        {
            $data="数据库连接失败".$e->getMessage();
        }

    }
    else {
        $data="两次输入密码不一致";
    }
}

echo $data;
 ?>
