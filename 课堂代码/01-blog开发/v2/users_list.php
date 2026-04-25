<?php
$pageTitle = '网站后台管理 - 用户列表';
$page = 'users';
include("header.php");
?>

    <main class="main-content">
        <div class="page-header page-header-bar">
            <div>
                <h2>用户管理</h2>
                <p>管理系统用户账号</p>
            </div>
            <a href="user_add.php" class="btn-add">
                <span>+</span>
                <span>添加用户</span>
            </a>
        </div>

        <div class="table-container">
            <table class="users-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>用户名</th>
                        <th>密码</th>
                        <th>邮箱</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // 连接mysql数据库
                    include("db.php");

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
                    ?>
                    <tr>
                        <td><?php echo $row["id"];?></td>
                        <td><?php echo $row["username"];?></td>
                        <td><span class="password-masked"><?php echo $row["password"];?></span></td>
                        <td><?php echo $row["email"];?></td>
                        <td>
                            <div class="action-btns">
                                <a href="user_edit.php?id=<?php echo $row["id"];?>" class="btn btn-edit">✏️ 编辑</a>
                                <a href="users.php?del&id=<?php echo $row["id"];?>" class="btn btn-delete"
                                    onclick="return confirm('确定要删除该用户吗？')">🗑️ 删除</a>
                            </div>
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </main>
</body>
</html>
