<?php
$pageTitle = '网站后台管理 - 修改文章';
$page = 'articles';
include("header.php");
?>

    <?php
    // 连接数据库
    include("db.php");

    // 接收文章ID
    $id = $_REQUEST["id"];

    if (isset($_POST["title"])) {
        // 接收标题，作者，内容等数据
        $title = $_POST["title"];
        $author = $_POST["author"];
        $content = $_POST["content"];

        // 设置为+8时区，读取系统时间
        date_default_timezone_set('PRC');
        $time = date("Y-m-d H:i:s");


        // 插入数据库
        $sql = "update articles set title='$title', author='$author', content='$content', time='$time' where id='$id'";
        if (mysqli_query($conn, $sql) === TRUE) {
            echo "<script>alert('文章添加成功');location.href='articles_list.php'</script>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    ?>

    <main class="main-content">
        <div class="page-header">
            <h2>修改文章</h2>
            <p>修改博客的文章</p>
        </div>
        <?php
        // 以及对应的内容
        $sql = "select * from articles where id = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="form-card">
            <form action="" method="post">
                <div class="form-group">
                    <label for="title">文章标题</label>
                    <input type="text" id="title" name="title" placeholder="请输入文章标题" value="<?php echo $row["title"]; ?>" required>
                </div>

                <div class="form-group">
                    <label for="author">文章作者</label>
                    <input type="text" id="author" name="author" placeholder="请输入文章作者" value="<?php echo $row["author"]; ?>" required>
                </div>

                <div class="form-group">
                    <label for="content">文章内容</label>
                    <textarea id="content" name="content" placeholder="请输入文章内容" required><?php echo $row["content"]; ?></textarea>
                </div>

                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">提交</button>
                    <a href="articles_list.php" class="btn btn-secondary">返回文章列表</a>
                </div>
            </form>
        </div>
    </main>
</body>

</html>
