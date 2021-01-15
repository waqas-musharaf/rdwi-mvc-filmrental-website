<?php

$sqlHost = 'localhost';
$sqlUser = 'u1561634';
$sqlPass = '19061997';
$sqlDB = 'u1561634';

$con = new mysqli($sqlHost, $sqlUser, $sqlPass, $sqlDB);

if ($con->connect_errno){
    printf("Failed: %s\n, $con->connect_error");
    exit();
}
?>
