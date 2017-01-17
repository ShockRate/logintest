<?php

$server ='localhost';
$username='root';
$password='tr@x17';
$database='logintest';

try{
    $conn =new PDO("mysql:host=$server;dbname=$database;",$username, $password);
}catch(PDOException $err){
    die("Connection Failed: ".$err->getMessage());
}
