<?php
$pageTitle = '网站后台管理 - 文章列表';
$page = 'commonts';
include_once("header.php");
?>

    <main class="main-content">
        <div class="page-header page-header-bar">
            <div>
                <h2>评论管理</h2>
                <p>管理博客的评论</p>
            </div>
        </div>

        <div class="table-container">
            <table class="articles-table">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>文章</th>
                        <th>昵称</th>
                        <th>发布时间</th>
                        <th>内容</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    // 删除文章的功能
                    if(isset($_REQUEST["del"])){
                        $id = $_REQUEST["id"];
                        $sql = "delete from comments where id = '$id'";
                        if (mysqli_query($conn, $sql) === TRUE) {
                            echo "<script>location.href='comment_list.php'</script>";
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    // 查询所有评论
                    $sql = "select * from comments order by id desc";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) { 
                        $sql = "select * from articles where id = '". $row['article_id']. "'";
                        $article_result = mysqli_query($conn, $sql);
                        $article_row = mysqli_fetch_assoc($article_result);
                        $article_title = $article_row["title"];
            
                    ?>
                    <tr>
                        <td><?php echo $row["id"];?></td>
                        <td><?php echo $article_title;?></td>
                        <td><?php echo $row["nick"];?></td>
                        <td><?php echo $row["time"];?></td>
                        <td><?php echo $row["content"];?></td>
                        <td>
                            <div class="action-btns">
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
