<?php
$pageTitle = '网站后台管理 - 用户添加';
$page = 'users';
include("header.php");
?>

    <?php
    // 根据传递的id，获取表中的各个信息
    // 连接mysql数据库
    include("db.php");

    $userid = $_REQUEST["id"];
    $sql = "select * from users where id='$userid'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    ?>

    <main class="main-content">
        <div class="page-header">
            <h2>添加用户</h2>
            <p>添加用户信息</p>
        </div>

        <div class="form-card form-card-sm">
            <form action="users.php" method="post">
                <div class="form-group">
                    <label for="username">用户名</label>
                    <input type="text" id="username" name="username" placeholder="请输入用户名" required>
                </div>

                <div class="form-group">
                    <label for="password">密码</label>
                    <input type="password" id="password" name="password" placeholder="请输入新密码" required>
                </div>

                <div class="form-group">
                    <label for="password2">确认密码</label>
                    <input type="password" id="password2" name="password2" placeholder="请再次输入新密码" required>
                </div>

                <div class="form-group">
                    <label for="email">邮箱</label>
                    <input type="email" id="email" name="email" placeholder="请输入邮箱地址" required>
                </div>

                <div class="btn-group">
                    <input type="submit" class="btn btn-primary" value="添加" name="add">
                    <a href="users_list.php" class="btn btn-secondary">取消</a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
