<?php

    $dbServerName = "localhost";
    $dbUserName = "root";
    $dbPassword = "";
    $dbName = "fullstack";
    
    $conn = mysqli_connect($dbServerName,$dbUserName,$dbPassword,$dbName);
    $conn->set_charset("utf8");
?>