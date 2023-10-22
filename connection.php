<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "product_db";

$connect = mysqli_connect($host, $username, $password, $dbname);

if ($connect->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>