<?php
$pageTitle = '网站后台管理 - 添加文章';
$page = 'articles';
include_once("header.php");
?>

<?php
if (isset($_REQUEST["title"])) {


    // 接收标题，作者，内容等数据
    $title = $_REQUEST["title"];
    $author = $_REQUEST["author"];
    $content = $_REQUEST["content"];

    // 设置为+8时区，读取系统时间
    date_default_timezone_set('PRC');
    $time = date("Y-m-d H:i:s");


    // 插入数据库
    $sql = "INSERT INTO articles (title, author, content, time) VALUES ('$title', '$author', '$content', '$time')";
    if (mysqli_query($conn, $sql) === TRUE) {
        echo "<script>alert('文章添加成功');location.href='articles_list.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<main class="main-content">
    <div class="page-header">
        <h2>添加文章</h2>
        <p>编写博客的文章</p>
    </div>

    <div class="form-card">
        <form action="" method="post">
            <div class="form-group">
                <label for="title">文章标题</label>
                <input type="text" id="title" name="title" placeholder="请输入文章标题" required>
            </div>

            <div class="form-group">
                <label for="author">文章作者</label>
                <input type="text" id="author" name="author" placeholder="请输入文章作者" required>
            </div>

            <div class="form-group">
                <label for="content">文章内容</label>
                <textarea id="content" name="content" placeholder="请输入文章内容" required></textarea>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">提交</button>
                <a href="articles_list.php" class="btn btn-secondary">返回文章列表</a>
            </div>
        </form>
    </div>
</main>
<script src="ueditor/ueditor.config.js"></script>
<script src="ueditor/ueditor.all.min.js"></script>
<script src="ueditor/lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" charset="utf-8">
    window.UEDITOR_HOME_URL = "/ueditor/"; //配置路径设定为UEditor所放的位置
    window.onload = function () {
        // window.UEDITOR_CONFIG.initalFrameHeight=600;
        // window.UEDITOR_CONFIG.initalFrameWidth=1200;
        var editor = new UE.ui.Editor({
            imageUrl: '',
            fileUrl: '',
            imagePath: '',
            filePath: '',
            imageManagerUrl: '',
            imageManagerPath: ''
        });
        editor.render("content"); //此处的id要和textarea标签的id对应
    }
</script>
</body>

</html>