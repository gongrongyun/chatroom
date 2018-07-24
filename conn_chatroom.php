<?php
    session_start();
    //链接数据库
    $db_pass="";
    try{
        $conn = new PDO("mysql:host=localhost;dbname=chat_room","root",$db_pass);
        $conn->exec("SET NAMES UTF8");
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    // 存入聊天数据
    if(isset($_POST["name"]) && isset($_POST["content"]) && isset($_POST["time"])){
      $name = $_POST["name"];
      $content = $_POST["content"];
      $flag = 0;
      if($name === $_SESSION['name']){
          $flag = 1;
      }
      if($flag){
          $insert = $conn->prepare("INSERT INTO chat_room_table (name,content,time)VALUES(:name,:content,NOW())");
                  $insert -> bindValue(":name",$name);
                  $insert -> bindValue(":content",$content);
                  $insert -> execute();
          // $message=array();
          // $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
          // $conn->bindValue("name:",name);
          // $sql="INSERT INTO chat_room_table (name,content,status) VALUES ("$name","$content",$status)";
          // $conn->exec($sql);
          //   $data = "success";
          //   echo json_encode($data);
          // }
          // else {
          //     echo "fcdcw";
          // }
      }
      else {
          echo "请你不要皮";
      }
    }

?>
