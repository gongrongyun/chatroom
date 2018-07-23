<?php
    $filename = $_FILES['file'];
    if(move_uploaded_file($filename['tmp_name'],'/download/www/chatroom/'.$filename['name'])){
        echo json_encode($filename['name']);
    }
    else{
        echo "error";
    }
?>
