<?php
    $db_pass="";
    try {
      $conn = new PDO('mysql:host=127.0.0.1;dbname=chat_room','root', $db_pass);
      $conn->exec('SET NAMES UTFS');
      $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "connection faild:".$e->getMessage();
    }
    $last_id=$_GET['last_id'];
    $result=$conn->prepare("SELECT * from chat_room_table WHERE id>$last_id");
    if ($result->execute()) {
      $row=$result->fetchAll(PDO::FETCH_ASSOC);
      $i=0;
      foreach ($row as $value) {
        $arr[$i++]=[
          "name" => $value['name'],
          "concent" => $value['content'],
          "time" => $value['time'],
          "last_id" => $value['id'],
        ];
      }
      $last_id += $i;
      //返回的时候要以数组的形式返回
      // "id"=>$value['id'];
      // echo $i;
      echo json_encode($arr);
    }
?>
