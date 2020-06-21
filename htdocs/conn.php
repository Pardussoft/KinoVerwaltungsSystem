<?php

    $conn = mysqli_connect("127.0.0.1", "master", "ke12re34", "filmdb");

    if ($conn->connect_errno) {
        echo "Konnte nicht an MYSQL verbunden werden!!!, Error:".$mysqli->connect_error;
        exit();
    }

    //Chartset query
    $result = $conn->query("SET NAMES UTF8;");
    
?>