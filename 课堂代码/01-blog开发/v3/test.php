<?php
// 字符集设置为utf-8
header("Content-Type: text/html; charset=UTF-8");

// 连接mysql数据库
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

// 获取users表中的所有数据
$sql = "select * from users";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "查询失败";
    exit;
}

// 将查询的数据一行行输出
// mysqli_fetch_assoc函数是将查询的数据以关联数组的形式返回，数组的key是字段名，value是字段值
while ($row = mysqli_fetch_assoc($result)) {
    echo "<p>" . $row["username"] . ":" . $row["email"] . ":" . $row["password"] . "</p>";
}