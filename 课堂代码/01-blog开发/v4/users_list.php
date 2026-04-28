<?php
$pageTitle = '网站后台管理 - 用户列表';
$page = 'users';
include_once("header.php");
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
                        <td>
                            <span class="username-tooltip">
                                <?php echo $row["username"];?>
                                <span class="tooltip-content">
                                    <?php if ($row["avatar"]): ?>
                                        <img src="<?php echo $row["avatar"];?>" alt="头像">
                                    <?php else: ?>
                                        <div class="tooltip-avatar-placeholder">&#128100;</div>
                                    <?php endif; ?>
                                </span>
                            </span>
                        </td>
                        <td><span class="password-masked"><?php echo $row["password"];?></span></td>
                        <td><?php echo $row["email"];?></td>
                        <td>
                            <div class="action-btns">
                                <a href="user_edit.php?id=<?php echo $row["id"];?>" class="btn btn-edit">✏️ 编辑</a>
                                <a href="users.php?del&id=<?php echo $row["id"];?>" class="btn btn-delete"
                                    onclick="return confirm('确定要删除该用户吗？')">🗑️ 删除</a>
                                    <a href="user_avatar.php?id=<?php echo $row["id"];?>" class="btn btn-edit">&#128100; 修改头像</a>
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

    <style>
        .username-tooltip {
            position: relative;
            cursor: pointer;
            color: #3b82f6;
            font-weight: 500;
            display: inline-block;
        }

        .users-table td:nth-child(2) {
            position: relative;
            overflow: visible;
        }

        .table-container {
            overflow: visible !important;
        }

        .users-table {
            overflow: visible !important;
        }

        .username-tooltip:hover {
            text-decoration: underline;
        }

        .tooltip-content {
            display: none;
            position: absolute;
            left: 50%;
            bottom: calc(100% + 10px);
            transform: translateX(-50%);
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 8px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            z-index: 9999;
            white-space: nowrap;
            overflow: visible;
        }

        .tooltip-content::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -6px;
            transform: translateX(-50%);
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid #ffffff;
        }

        .tooltip-content::before {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -7px;
            transform: translateX(-50%);
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-top: 6px solid #e5e7eb;
        }

        .username-tooltip:hover .tooltip-content {
            display: block;
            animation: tooltipFadeIn 0.2s ease;
        }

        .tooltip-content img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            display: block;
        }

        .tooltip-avatar-placeholder {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            color: #9ca3af;
        }

        @keyframes tooltipFadeIn {
            from {
                opacity: 0;
                transform: translateX(-50%) translateY(4px);
            }
            to {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }
        }
    </style>
</body>
</html>
