<?php
// 连接数据库
$host = "127.0.0.1";
$dbname = "root";
$dbpassword = "usbw";
$database = "blog";
$port = 3307;
$conn = mysqli_connect($host, $dbname, $dbpassword, $database, $port);
if (!$conn) {
    echo "连接失败";
    exit;
}