<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbName = "crud";
$charset = "UTF-8";

//MySQLi
//$connect = mysqli_connect($servername, $username, $password, $dbName);
//
//if ($connect->connect_error) {
//    die("Connection failed: " . $connect->connect_error);
//}else{
//    echo "Connected successfully";
//}


//PDO
try {
    $connect = new PDO("mysql:host=localhost;dbname=crud;", "root", "");
    // set the PDO error mode to exception
    $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}

//$connect->set_charset("UTF-8");
?>