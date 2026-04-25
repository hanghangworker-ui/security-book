<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <?php
    include("db.php");
    $id = $_GET["id"];
    $sql = "SELECT * FROM articles WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if (!$row) {
        echo "<script>location.href='index.php';</script>";
        exit;
    }
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($row["title"]); ?> — 许老师的小站</title>
    <style>
        /* ========== 基础重置 ========== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #6366f1;
            --primary-light: #818cf8;
            --accent: #f59e0b;
            --bg-page: #f8f9fc;
            --bg-card: #ffffff;
            --bg-card-hover: #f5f7ff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --gradient-1: linear-gradient(135deg, #6366f1, #8b5cf6, #ec4899);
            --gradient-2: linear-gradient(135deg, #f59e0b, #ef4444, #ec4899);
            --shadow: 0 4px 24px rgba(99, 102, 241, 0.08);
            --shadow-hover: 0 8px 40px rgba(99, 102, 241, 0.12);
            --radius: 20px;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', 'PingFang SC', 'Microsoft YaHei', -apple-system, BlinkMacSystemFont, sans-serif;
            background-color: var(--bg-page);
            color: var(--text-primary);
            min-height: 100vh;
            overflow-x: hidden;
            -webkit-font-smoothing: antialiased;
            line-height: 1.6;
        }

        ::-webkit-scrollbar { width: 6px; }
        ::-webkit-scrollbar-track { background: var(--bg-page); }
        ::-webkit-scrollbar-thumb { background: var(--primary); border-radius: 3px; }

        /* ========== 装饰背景 ========== */
        .bg-decoration {
            position: fixed;
            inset: 0;
            z-index: 0;
            pointer-events: none;
            overflow: hidden;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.6;
        }

        .bg-circle-1 {
            width: 400px; height: 400px;
            background: rgba(99, 102, 241, 0.07);
            top: -100px; left: -100px;
            animation: floatBg 22s ease-in-out infinite;
        }

        .bg-circle-2 {
            width: 350px; height: 350px;
            background: rgba(236, 72, 153, 0.05);
            bottom: 5%; right: -80px;
            animation: floatBg 18s ease-in-out infinite reverse;
        }

        @keyframes floatBg {
            0%, 100% { transform: translate(0, 0); }
            50% { transform: translate(25px, -30px); }
        }

        /* ========== 阅读进度条 ========== */
        .reading-progress {
            position: fixed;
            top: 0; left: 0;
            height: 3px;
            background: var(--gradient-1);
            z-index: 200;
            width: 0%;
            border-radius: 0 2px 2px 0;
            box-shadow: 0 0 12px rgba(99, 102, 241, 0.5);
            transition: width 0.15s linear;
        }

        /* ========== 导航栏 ========== */
        .navbar {
            position: fixed;
            top: 0; left: 0; right: 0;
            z-index: 100;
            padding: 0 48px;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            background: rgba(248, 249, 252, 0.82);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--border);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .navbar.scrolled {
            height: 62px;
            background: rgba(248, 249, 252, 0.96);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.06);
        }

        .nav-back {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 18px;
            background: rgba(99, 102, 241, 0.06);
            border: 1px solid rgba(99, 102, 241, 0.12);
            border-radius: 12px;
            color: var(--primary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-back:hover {
            background: rgba(99, 102, 241, 0.1);
            border-color: rgba(99, 102, 241, 0.2);
            transform: translateX(-4px);
            box-shadow: 0 4px 16px rgba(99, 102, 241, 0.1);
        }

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-primary);
        }

        .nav-brand-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--gradient-1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            transition: transform 0.3s ease;
        }

        .nav-brand:hover .nav-brand-icon {
            transform: rotate(-8deg) scale(1.1);
        }

        .nav-brand-text {
            font-size: 16px;
            font-weight: 700;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-actions { display: flex; align-items: center; gap: 12px; }

        .btn-admin {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            background: var(--gradient-1);
            color: #fff;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .btn-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        /* ========== 文章主体 ========== */
        .article-wrapper {
            position: relative;
            z-index: 1;
            max-width: 760px;
            margin: 0 auto;
            padding: 120px 24px 80px;
            animation: pageIn 0.8s cubic-bezier(0.4, 0, 0.2, 1) forwards;
        }

        @keyframes pageIn {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ========== 文章头部 ========== */
        .article-header {
            margin-bottom: 48px;
            opacity: 0;
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.1s forwards;
        }

        .article-meta-top {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 24px;
        }

        .article-category {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(99, 102, 241, 0.08);
            border: 1px solid rgba(99, 102, 241, 0.12);
            border-radius: 50px;
            font-size: 12px;
            color: var(--primary);
            font-weight: 500;
        }

        .reading-time {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 6px 14px;
            background: rgba(245, 158, 11, 0.08);
            border: 1px solid rgba(245, 158, 11, 0.12);
            border-radius: 50px;
            font-size: 12px;
            color: var(--accent);
            font-weight: 500;
        }

        .article-title {
            font-size: clamp(26px, 5vw, 42px);
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -1px;
            margin-bottom: 28px;
            color: var(--text-primary);
        }

        .article-info {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px 24px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: var(--shadow);
        }

        .author-block { display: flex; align-items: center; gap: 12px; }

        .author-avatar-lg {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--gradient-2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .author-name { font-size: 15px; font-weight: 600; color: var(--text-primary); }
        .author-role { font-size: 12px; color: var(--text-muted); }

        .meta-divider { width: 1px; height: 36px; background: var(--border); }

        .meta-date {
            font-size: 14px;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: 6px;
        }

        /* ========== 文章正文 ========== */
        .article-body {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 48px;
            margin-bottom: 40px;
            opacity: 0;
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.2s forwards;
            box-shadow: var(--shadow);
            transition: box-shadow 0.4s ease, border-color 0.4s ease;
        }

        .article-body:hover {
            box-shadow: var(--shadow-hover);
            border-color: rgba(99, 102, 241, 0.15);
        }

        .article-content {
            font-size: 16px;
            line-height: 2;
            color: var(--text-secondary);
            word-wrap: break-word;
            white-space: pre-wrap;
        }

        .article-content p { margin-bottom: 20px; }
        .article-content p:last-child { margin-bottom: 0; }

        /* 首字下沉 */
        .article-content p:first-of-type::first-letter {
            font-size: 3.5em;
            font-weight: 800;
            float: left;
            line-height: 1;
            margin-right: 12px;
            margin-top: 4px;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* ========== 文章底部 ========== */
        .article-footer {
            opacity: 0;
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.3s forwards;
        }

        .article-tags {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 32px;
        }

        .article-tag {
            padding: 6px 16px;
            background: rgba(99, 102, 241, 0.06);
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 50px;
            font-size: 13px;
            color: var(--primary);
        }

        /* 分享栏 */
        .share-section {
            display: flex;
            align-items: center;
            gap: 16px;
            padding: 24px 28px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            margin-bottom: 40px;
            box-shadow: var(--shadow);
        }

        .share-text { font-size: 14px; font-weight: 600; color: var(--text-secondary); flex-shrink: 0; }

        .share-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: rgba(99, 102, 241, 0.06);
            border: 1px solid rgba(99, 102, 241, 0.1);
            color: var(--primary);
            font-size: 16px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .share-btn:hover {
            background: rgba(99, 102, 241, 0.12);
            border-color: rgba(99, 102, 241, 0.2);
            transform: translateY(-3px);
            box-shadow: 0 6px 16px rgba(99, 102, 241, 0.15);
        }

        /* ========== 返回导航 ========== */
        .back-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 24px 28px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            margin-bottom: 60px;
            box-shadow: var(--shadow);
        }

        .back-nav-link {
            display: flex;
            flex-direction: column;
            gap: 4px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .back-nav-link:hover { color: var(--primary); }

        .back-nav-link:hover:first-child { transform: translateX(-4px); }
        .back-nav-link:hover:last-child { transform: translateX(4px); }

        .back-nav-link.next { text-align: right; }

        .back-nav-label {
            font-size: 11px;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* ========== 评论区域 ========== */
        .comments-section {
            opacity: 0;
            animation: fadeInUp 0.8s cubic-bezier(0.4, 0, 0.2, 1) 0.4s forwards;
            margin-bottom: 60px;
        }

        .comments-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 28px;
        }

        .comments-title {
            font-size: 22px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .comments-count {
            padding: 4px 12px;
            background: rgba(99, 102, 241, 0.08);
            border: 1px solid rgba(99, 102, 241, 0.1);
            border-radius: 50px;
            font-size: 12px;
            color: var(--primary);
            font-weight: 600;
        }

        /* 评论表单 */
        .comment-form-card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 32px;
            margin-bottom: 36px;
            box-shadow: var(--shadow);
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .comment-form-card:focus-within {
            border-color: rgba(99, 102, 241, 0.25);
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.06), var(--shadow-hover);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-group { margin-bottom: 16px; }

        .form-group:last-child { margin-bottom: 0; }

        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .form-input,
        .form-textarea {
            width: 100%;
            padding: 12px 16px;
            font-size: 14px;
            font-family: inherit;
            color: var(--text-primary);
            background: var(--bg-page);
            border: 1.5px solid var(--border);
            border-radius: 12px;
            outline: none;
            transition: all 0.3s ease;
            letter-spacing: 0.3px;
        }

        .form-input:focus,
        .form-textarea:focus {
            border-color: var(--primary);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.06);
        }

        .form-input::placeholder,
        .form-textarea::placeholder {
            color: var(--text-muted);
        }

        .form-textarea {
            min-height: 120px;
            resize: vertical;
            line-height: 1.7;
        }

        .form-submit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: var(--gradient-1);
            color: #fff;
            border: none;
            border-radius: 12px;
            font-size: 14px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            box-shadow: 0 4px 16px rgba(99, 102, 241, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-top: 4px;
        }

        .form-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        .form-submit:active {
            transform: translateY(0);
        }

        /* 评论列表 */
        .comments-list {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .comment-item {
            display: flex;
            gap: 16px;
            padding: 24px;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(20px);
        }

        .comment-item.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .comment-item:hover {
            border-color: rgba(99, 102, 241, 0.15);
            box-shadow: var(--shadow);
        }

        .comment-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--gradient-1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .comment-avatar.pink { background: var(--gradient-2); }
        .comment-avatar.orange { background: linear-gradient(135deg, #f59e0b, #f97316); }

        .comment-body { flex: 1; min-width: 0; }

        .comment-meta {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 10px;
        }

        .comment-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-primary);
        }

        .comment-time {
            font-size: 12px;
            color: var(--text-muted);
        }

        .comment-badge {
            padding: 2px 8px;
            background: rgba(99, 102, 241, 0.08);
            border-radius: 6px;
            font-size: 11px;
            color: var(--primary);
            font-weight: 600;
        }

        .comment-text {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.7;
        }

        /* 空评论 */
        .comments-empty {
            text-align: center;
            padding: 48px 20px;
            background: var(--bg-card);
            border: 1px dashed var(--border);
            border-radius: 16px;
        }

        .comments-empty-icon { font-size: 48px; margin-bottom: 16px; opacity: 0.25; }
        .comments-empty h4 { font-size: 16px; color: var(--text-secondary); margin-bottom: 6px; }
        .comments-empty p { font-size: 13px; color: var(--text-muted); }

        /* ========== 底部 ========== */
        .footer {
            text-align: center;
            padding: 40px 24px;
            border-top: 1px solid var(--border);
        }

        .footer-text { font-size: 14px; color: var(--text-muted); }
        .footer-text span { color: var(--primary); font-weight: 600; }

        /* ========== 响应式 ========== */
        @media (max-width: 768px) {
            .navbar { padding: 0 20px; }
            .article-wrapper { padding: 100px 16px 60px; }
            .article-body { padding: 28px 20px; }
            .article-info { flex-direction: column; align-items: flex-start; gap: 12px; }
            .meta-divider { display: none; }
            .form-row { grid-template-columns: 1fr; }
            .share-section { flex-wrap: wrap; }
            .back-nav { flex-direction: column; gap: 20px; text-align: center; }
            .back-nav-link.next { text-align: center; }
            .comment-item { flex-direction: column; gap: 12px; }
        }

        ::selection {
            background: rgba(99, 102, 241, 0.2);
            color: var(--text-primary);
        }
    </style>
</head>
<body>
    <!-- 阅读进度条 -->
    <div class="reading-progress" id="readingProgress"></div>

    <!-- 装饰背景 -->
    <div class="bg-decoration">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
    </div>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar">
        <a href="index.php" class="nav-back">
            <span>&#8592;</span>
            <span>返回首页</span>
        </a>
        <a href="index.php" class="nav-brand">
            <div class="nav-brand-icon">&#10022;</div>
            <span class="nav-brand-text">许老师的小站</span>
        </a>
        <div class="nav-actions">
            <a href="main.php" class="btn-admin" target="_blank">
                <span>&#9998;</span>
                <span>管理</span>
            </a>
        </div>
    </nav>

    <!-- 文章主体 -->
    <div class="article-wrapper">
        <!-- 文章头部 -->
        <header class="article-header">
            <div class="article-meta-top">
                <span class="article-category">&#128196; 笔记</span>
                <span class="reading-time">
                    &#9201; <?php
                        $wordCount = mb_strlen(strip_tags($row["content"]), 'utf-8');
                        $readTime = ceil($wordCount / 400);
                        echo $readTime . ' 分钟阅读';
                    ?>
                </span>
            </div>

            <h1 class="article-title"><?php echo htmlspecialchars($row["title"]); ?></h1>

            <div class="article-info">
                <div class="author-block">
                    <div class="author-avatar-lg"><?php echo mb_substr($row["author"], 0, 1, 'utf-8'); ?></div>
                    <div>
                        <div class="author-name"><?php echo htmlspecialchars($row["author"]); ?></div>
                        <div class="author-role">作者</div>
                    </div>
                </div>
                <div class="meta-divider"></div>
                <div class="meta-date">
                    <span>&#128339;</span>
                    <span><?php echo date('Y年m月d日 H:i', strtotime($row["time"])); ?></span>
                </div>
            </div>
        </header>

        <!-- 文章正文 -->
        <article class="article-body">
            <div class="article-content"><?php echo htmlspecialchars($row["content"]); ?></div>
        </article>

        <!-- 文章底部 -->
        <footer class="article-footer">
            <div class="article-tags">
                <span class="article-tag"># <?php echo htmlspecialchars($row["author"]); ?></span>
                <span class="article-tag"># 笔记</span>
                <span class="article-tag"># <?php echo date('Y', strtotime($row["time"])); ?></span>
            </div>

            <div class="share-section">
                <span class="share-text">分享这篇文章</span>
                <a href="javascript:void(0)" class="share-btn" title="复制链接" onclick="copyLink()">&#128279;</a>
                <a href="javascript:void(0)" class="share-btn" title="赞一下" onclick="this.style.color='#ef4444';this.style.transform='scale(1.2)'">&#9829;</a>
                <a href="index.php" class="share-btn" title="返回首页">&#127968;</a>
            </div>

            <div class="back-nav">
                <a href="index.php" class="back-nav-link">
                    <span class="back-nav-label">&#8592; 返回</span>
                    <span>返回文章列表</span>
                </a>
                <a href="main.php" class="back-nav-link next" target="_blank">
                    <span class="back-nav-label">管理 &#8594;</span>
                    <span>进入后台管理</span>
                </a>
            </div>
        </footer>

        <!-- ========== 评论区域 ========== -->
        <section class="comments-section" id="comments">
            <div class="comments-header">
                <h2 class="comments-title">&#128172; 评论</h2>
                <span class="comments-count" id="commentCount">0</span>
            </div>

            <!-- 评论表单 -->
            <div class="comment-form-card">
                <form id="commentForm" onsubmit="return handleCommentSubmit(event)">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="commentName">昵称 *</label>
                            <input
                                type="text"
                                id="commentName"
                                name="name"
                                class="form-input"
                                placeholder="请输入你的昵称"
                                required
                                maxlength="30"
                            >
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="commentEmail">邮箱（选填）</label>
                            <input
                                type="email"
                                id="commentEmail"
                                name="email"
                                class="form-input"
                                placeholder="用于接收回复通知"
                                maxlength="60"
                            >
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="commentContent">评论内容 *</label>
                        <textarea
                            id="commentContent"
                            name="content"
                            class="form-textarea"
                            placeholder="写下你的想法..."
                            required
                            maxlength="500"
                        ></textarea>
                    </div>
                    <button type="submit" class="form-submit">
                        <span>&#10148;</span>
                        <span>发表评论</span>
                    </button>
                </form>
            </div>

            <!-- 评论列表（示例数据，实际接入后端后替换） -->
            <div class="comments-list" id="commentsList">
                <!-- 预留：后端接入后在此循环输出评论 -->
                <!-- 示例占位评论 -->
                <div class="comment-item visible">
                    <div class="comment-avatar">林</div>
                    <div class="comment-body">
                        <div class="comment-meta">
                            <span class="comment-name">林同学</span>
                            <span class="comment-badge">作者</span>
                            <span class="comment-time">2026-04-20 14:32</span>
                        </div>
                        <p class="comment-text">写得真好！深受启发，期待更多精彩内容~</p>
                    </div>
                </div>

                <div class="comment-item visible">
                    <div class="comment-avatar pink">张</div>
                    <div class="comment-body">
                        <div class="comment-meta">
                            <span class="comment-name">张三丰</span>
                            <span class="comment-time">2026-04-18 09:15</span>
                        </div>
                        <p class="comment-text">思路很清晰，帮助我解决了一个困扰很久的问题。</p>
                    </div>
                </div>

                <div class="comment-item visible">
                    <div class="comment-avatar orange">王</div>
                    <div class="comment-body">
                        <div class="comment-meta">
                            <span class="comment-name">王小明</span>
                            <span class="comment-time">2026-04-15 20:05</span>
                        </div>
                        <p class="comment-text">收藏了！</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 底部 -->
        <footer class="footer">
            <p class="footer-text">
                &copy; <?php echo date('Y'); ?> <span>许老师的小站</span> &middot; 用心记录每一天
            </p>
        </footer>
    </div>

    <script>
        // 阅读进度条
        const progressBar = document.getElementById('readingProgress');
        const articleBody = document.querySelector('.article-body');

        function updateProgress() {
            const rect = articleBody.getBoundingClientRect();
            const windowHeight = window.innerHeight;
            const articleTop = rect.top + window.scrollY;
            const articleHeight = rect.height;
            const scrolled = window.scrollY + windowHeight - articleTop;
            const progress = Math.max(0, Math.min(100, (scrolled / articleHeight) * 100));
            progressBar.style.width = progress + '%';
        }

        window.addEventListener('scroll', updateProgress, { passive: true });
        window.addEventListener('resize', updateProgress, { passive: true });

        // 导航栏滚动
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        }, { passive: true });

        // 复制链接
        function copyLink() {
            navigator.clipboard.writeText(window.location.href).then(() => {
                const btn = document.querySelectorAll('.share-btn')[0];
                btn.textContent = '✓';
                btn.style.color = '#22c55e';
                btn.style.background = 'rgba(34, 197, 94, 0.1)';
                btn.style.borderColor = 'rgba(34, 197, 94, 0.2)';
                setTimeout(() => {
                    btn.textContent = '🔗';
                    btn.style.color = '';
                    btn.style.background = '';
                    btn.style.borderColor = '';
                }, 2000);
            });
        }

        // 评论表单提交（预留）
        function handleCommentSubmit(e) {
            e.preventDefault();
            const name = document.getElementById('commentName').value.trim();
            const content = document.getElementById('commentContent').value.trim();

            if (!name || !content) return false;

            // =============================================
            // TODO: 后端接入时，在此发起 AJAX 请求
            // 示例：
            // fetch('comment.php', {
            //     method: 'POST',
            //     body: new URLSearchParams({
            //         article_id: '<?php echo $id; ?>',
            //         name: name,
            //         email: document.getElementById('commentEmail').value.trim(),
            //         content: content
            //     })
            // }).then(res => res.json()).then(data => {
            //     // 追加新评论到列表
            // });
            // =============================================

            // 模拟提交成功
            const list = document.getElementById('commentsList');
            const initials = name.charAt(0).toUpperCase();
            const now = new Date();
            const timeStr = now.getFullYear() + '-' +
                String(now.getMonth() + 1).padStart(2, '0') + '-' +
                String(now.getDate()).padStart(2, '0') + ' ' +
                String(now.getHours()).padStart(2, '0') + ':' +
                String(now.getMinutes()).padStart(2, '0');

            const avatarColors = ['gradient-1', 'pink', 'orange'];
            const colorClass = avatarColors[Math.floor(Math.random() * avatarColors.length)];

            const newComment = document.createElement('div');
            newComment.className = 'comment-item visible';
            newComment.innerHTML = `
                <div class="comment-avatar ${colorClass}">${initials}</div>
                <div class="comment-body">
                    <div class="comment-meta">
                        <span class="comment-name">${name}</span>
                        <span class="comment-time">${timeStr}</span>
                    </div>
                    <p class="comment-text">${content}</p>
                </div>
            `;
            list.prepend(newComment);

            // 更新计数
            const countEl = document.getElementById('commentCount');
            countEl.textContent = parseInt(countEl.textContent) + 1;

            // 清空表单
            document.getElementById('commentForm').reset();

            return false;
        }

        // 评论入场动画
        const commentItems = document.querySelectorAll('.comment-item');
        const commentObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), index * 100);
                    commentObserver.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1 });
        commentItems.forEach(item => commentObserver.observe(item));
    </script>
</body>
</html>
