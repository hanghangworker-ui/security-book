<?php
$pageTitle = '网站后台管理 - 修改文章';
$page = 'articles';
include_once("header.php");
?>

<?php
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
        echo "<script>alert('文章修改成功');location.href='articles_list.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// 获取文章内容用于编辑器初始化
$sql = "select * from articles where id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$initialContent = htmlspecialchars($row["content"], ENT_QUOTES, 'UTF-8');
?>

<!-- 引入 Vditor -->
<link rel="stylesheet" href="https://unpkg.com/vditor@3.10.8/dist/index.css" />
<script src="https://unpkg.com/vditor@3.10.8/dist/index.min.js"></script>

<main class="main-content">
    <div class="page-header">
        <h2>修改文章</h2>
        <p>修改博客的文章</p>
    </div>
    <div class="form-card">
        <form action="" method="post">
            <div class="form-group">
                <label for="title">文章标题</label>
                <input type="text" id="title" name="title" placeholder="请输入文章标题" value="<?php echo $row["title"]; ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="author">文章作者</label>
                <input type="text" id="author" name="author" placeholder="请输入文章作者" value="<?php echo $row["author"]; ?>"
                    required>
            </div>

            <div class="form-group">
                <label for="content">文章内容</label>
                <div id="vditor"></div>
                <textarea id="content" name="content" style="display:none;" required></textarea>
            </div>

            <div class="btn-group">
                <button type="submit" class="btn btn-primary">提交</button>
                <a href="articles_list.php" class="btn btn-secondary">返回文章列表</a>
            </div>
        </form>
    </div>
</main>

<script>
    // 初始化 Vditor
    const vditor = new Vditor('vditor', {
        height: 480,
        placeholder: '请输入文章内容...',
        theme: 'classic',
        toolbar: [
            'headings',
            'bold',
            'italic',
            'strike',
            '|',
            'line',
            'quote',
            'list',
            'ordered-list',
            'check',
            '|',
            'code',
            'inline-code',
            'link',
            'table',
            '|',
            'undo',
            'redo',
            '|',
            'preview',
            'fullscreen'
        ],
        input: (value) => {
            // 同步内容到 textarea
            document.getElementById('content').value = value;
        },
        after: () => {
            // 初始化完成后设置内容
            vditor.setValue(<?php echo json_encode($row["content"]); ?>);
        }
    });

    // 表单提交前同步内容
    document.querySelector('form').addEventListener('submit', function() {
        document.getElementById('content').value = vditor.getValue();
    });
</script>

<style>
    .vditor {
        border: 1px solid #d1d5db !important;
        border-radius: 8px !important;
    }

    .vditor-reset {
        font-family: inherit !important;
        font-size: 14px !important;
    }
</style>

</body>
</html>
