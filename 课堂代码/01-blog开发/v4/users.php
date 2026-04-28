<?php
// 处理用户登录、注册、修改、退出、删除相关的代码
// 设置页面的字符编码为UTF-8
header("Content-Type: text/html; charset=UTF-8");

// 连接mysql数据库
// include函数相当于将db.php文件中的代码复制到这里，就不用在每个页面中都写一遍了
include_once("db.php");
session_start();

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
        $_SESSION["username"] = $username;
        echo "<script>alert('登录成功');location.href='main.php'</script>";
    } else {
        echo "<script>alert('登录失败');location.href='login.php'</script>";
    }

} else if (isset($_REQUEST["register"]) or isset( $_REQUEST["add"])) {
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
        if(isset($_REQUEST["add"])) {
            echo "<script>alert('添加成功');location.href='users_list.php'</script>";
        } else {
            echo "<script>alert('注册成功');location.href='login.php'</script>";
        }
    } else {
        if(isset($_REQUEST["add"])) {
            echo "<script>alert('添加失败');location.href='users_list.php'</script>";
        } else {
            echo "<script>alert('注册失败');location.href='login.php'</script>";
        }
    }
} else if (isset($_REQUEST["change"])) {
    // 修改用户信息的操作
    $userid = $_REQUEST["id"];
    $username = $_REQUEST["username"];
    $email = $_REQUEST["email"];

    // 判断是否需要修改密码,判断密码的长度
    if (strlen($_REQUEST["password"]) > 0) {
        $password = $_REQUEST["password"];
        $password2 = $_REQUEST["password2"];
        if ($password != $password2) {
            echo "<script>alert('两次密码不一致');location.href='users_list.php'</script>";
            exit;
        }
        // 更新用户名，密码，邮箱
        // 存在逻辑漏洞，没有判断用户名是否存在，可以修改别人的用户名
        $sql = "update users set username='$username', password='$password', email='$email' where id='$userid'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('修改成功');location.href='users_list.php'</script>";
        } else {
            echo "<script>alert('修改失败');location.href='users_list.php'</script>";
        }
    } else {
        // 更新用户名和邮箱
        $sql = "update users set username='$username', email='$email' where id='$userid'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "<script>alert('修改成功');location.href='users_list.php'</script>";
        } else {
            echo "<script>alert('修改失败');location.href='users_list.php'</script>";
        }
    }
} else if (isset($_REQUEST["del"])) {
    // 删除用户
    $userid = $_REQUEST["id"];
    $sql = "delete from users where id='$userid'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('删除成功');location.href='users_list.php'</script>";
    } else {
        echo "<script>alert('删除失败');location.href='users_list.php'</script>";
    }
} else {
    echo "错误操作";
}


?>