<?php
// 处理用户登录和注册相关的代码
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


// 先判断$_REQUEST中是否存在'login'或'register'参数，如果存在，则执行对应的操作，否则返回错误信息
// isset 判断变量是否存在
if (isset($_REQUEST["login"])) {
    // 从前端接受用户名和密码，并且去数据库中验证
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    
    // 写sql语句
    $sql = "select * from users where username='$username' and password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo "登录成功";
    }else{
        echo "用户名或密码错误";
    }

}else if(isset($_REQUEST["register"])){
    // 从前端获取用户名，以及两次密码输入，以及邮箱
    $username = $_REQUEST["username"];
    $password = $_REQUEST["password"];
    $password2 = $_REQUEST["password2"];
    $email = $_REQUEST["email"];

    // 判断两次密码是否一致
    if ($password != $password2) {
        echo "两次密码不一致";
        exit;
    }

    // 判断用户名或邮箱是否已存在
    $sql = "select * from users where username='$username' or email='$email'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "用户名或邮箱已存在";
        exit;
    }

    // 写sql语句，插入一条新的用户记录
    $sql = "insert into users(username, password, email) values('$username', '$password', '$email')";
    $result = mysqli_query($conn, $sql);

    // 插入成功后，返回注册成功信息
    if ($result) {
        echo "注册成功";
    } else {
        echo "注册失败";
    }
    
}else{
    echo "错误操作";
}





// // 从前端获取用户名和密码
// $username = $_REQUEST["username"];
// $password = $_REQUEST["password"];




// // 查询数据库中的users表，并且将$username和$password作为条件查询
// $sql = "select * from users where username='$username' and password='$password'";
// $result = mysqli_query($conn, $sql);
// if (!$result) {
//     echo "查询失败";
//     exit;
// }

// // 如果查询结果为空，则提示用户名或密码错误
// if (mysqli_num_rows($result) == 0) {
//     echo "用户名或密码错误 <a href='login.html'>返回登录页面</a>";
//     exit;
// }else{
//     echo "登录成功";
// }

?>