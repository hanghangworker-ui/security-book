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

// 设置连接的字符集为utf8
mysqli_query($conn,"set names utf8");

