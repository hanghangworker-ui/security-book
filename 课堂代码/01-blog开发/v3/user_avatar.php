<?php
$pageTitle = '网站后台管理 - 头像修改';
$page = 'users';
include("header.php");
?>

<?php
include("db.php");
if (count($_FILES) > 0) {
    // php传图片会默认放在临时目录下，在程序执行结束后就会自动删除
    // php上传图片，本质上就是从临时目录中将文件及时移动到指定目录下
    // 先获取图片的格式
    $ext = pathinfo($_FILES["avatar"]["name"], PATHINFO_EXTENSION);
    $img_path = "images/avatar/" . date("YmdHis") . mt_rand(10000, 99999) . "." . $ext;
    move_uploaded_file($_FILES["avatar"]["tmp_name"], $img_path);

    // 写入数据库中
    $id = $_GET["id"];
    $sql = "UPDATE users SET avatar = '$img_path' WHERE id = $id";
    if (mysqli_query($conn, $sql) === TRUE) {
        echo "<script>alert('头像修改成功');location.href='users_list.php'</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
// 获取当前的头像
$sql = "select * from users where id = '" . $_GET["id"] . "'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$avatar = $row["avatar"];
?>

    <main class="main-content">
        <div class="page-header page-header-bar">
            <div>
                <h2>头像修改</h2>
                <p>更新用户头像</p>
            </div>
        </div>

        <div class="form-card">
            <div class="avatar-preview">
                <div class="avatar-current">
                    <p class="avatar-label">当前头像</p>
                    <div class="avatar-img-wrap">
                        <?php if ($avatar): ?>
                            <img src="<?php echo $avatar; ?>" alt="当前头像">
                        <?php else: ?>
                            <div class="avatar-placeholder">&#128100;</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="avatar">上传新头像</label>
                    <div class="file-upload-wrap">
                        <input type="file" name="avatar" id="avatar" accept="image/*" required>
                    </div>
                    <p class="form-hint">支持 JPG、PNG、GIF 格式，文件大小不超过 2MB</p>
                </div>
                <div class="btn-group">
                    <button type="submit" class="btn btn-primary">
                        <span>&#128190;</span>
                        <span>上传头像</span>
                    </button>
                    <a href="users_list.php" class="btn btn-secondary">取消</a>
                </div>
            </form>
        </div>
    </main>

    <style>
        .avatar-preview {
            display: flex;
            justify-content: center;
            margin-bottom: 32px;
        }

        .avatar-current {
            text-align: center;
        }

        .avatar-label {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 16px;
            letter-spacing: 0.5px;
        }

        .avatar-img-wrap {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #e5e7eb;
            background: #f9fafb;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            transition: border-color 0.2s ease;
        }

        .avatar-img-wrap:hover {
            border-color: #3b82f6;
        }

        .avatar-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-placeholder {
            font-size: 48px;
            color: #9ca3af;
        }

        .file-upload-wrap input[type="file"] {
            padding: 10px 16px;
            background: #f9fafb;
            border: 2px dashed #d1d5db;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .file-upload-wrap input[type="file"]:hover {
            border-color: #3b82f6;
            background: #eff6ff;
        }
    </style>
</body>
</html>
