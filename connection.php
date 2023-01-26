<?php
    $dbServerName = "localhost";
    $dbUserName = "root";
    $dbPassWord = "";
    $dbName = "gestion_des_nfts";
    $connection = new mysqli($dbServerName, $dbUserName, $dbPassWord, $dbName);

    if(!$connection)
    {
        die("ERROR<br>");
    }