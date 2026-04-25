<?php
$pageTitle = '网站后台管理 - 文章列表';
$page = 'articles';
include("header.php");
?>

    <main class="main-content">
        <div class="page-header page-header-bar">
            <div>
                <h2>文章管理</h2>
                <p>管理博客的文章</p>
            </div>
            <a href="article_add.php" class="btn-add">
                <span>+</span>
                <span>添加文章</span>
            </a>
        </div>

        <div class="table-container">
            <table class="articles-table">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>标题</th>
                        <th>作者</th>
                        <th>发布时间</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // 连接数据库
                    include("db.php");

                    // 删除文章的功能
                    if(isset($_REQUEST["del"])){
                        $id = $_REQUEST["id"];
                        $sql = "delete from articles where id = '$id'";
                        if (mysqli_query($conn, $sql) === TRUE) {
                            echo "<script>alert('文章删除成功');location.href='articles_list.php'</script>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    // 查询所有文章
                    $sql = "select * from articles";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) { 
                        // 标题超过10个字，就加省略号
                        $title = strlen($row["title"]) > 45 ? substr($row["title"], 0, 45) . "..." : $row["title"];
                    ?>
                    <tr>
                        <td><?php echo $row["id"];?></td>
                        <td><?php echo $title;?></td>
                        <td><?php echo $row["author"];?></td>
                        <td><?php echo $row["time"];?></td>
                        <td>
                            <div class="action-btns">
                                <a href="article_edit.php?id=<?php echo $row["id"];?>" class="btn btn-edit">✏️ 编辑</a>
                                <a href="?del&id=<?php echo $row["id"];?>" class="btn btn-delete" onclick="return confirm('确定要删除该文章吗？')">🗑️ 删除</a>
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
