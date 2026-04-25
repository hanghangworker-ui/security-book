<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>许老师的小站 — 笔记与随笔</title>
    <style>
        /* ========== 基础重置 ========== */
        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary: #6366f1;
            --primary-dark: #4f46e5;
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
            --shadow-hover: 0 12px 40px rgba(99, 102, 241, 0.14);
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
            width: 500px; height: 500px;
            background: rgba(99, 102, 241, 0.08);
            top: -150px; right: -100px;
            animation: floatBg 25s ease-in-out infinite;
        }

        .bg-circle-2 {
            width: 400px; height: 400px;
            background: rgba(236, 72, 153, 0.05);
            bottom: 10%; left: -80px;
            animation: floatBg 20s ease-in-out infinite reverse;
        }

        .bg-circle-3 {
            width: 300px; height: 300px;
            background: rgba(245, 158, 11, 0.05);
            top: 50%; right: 10%;
            animation: floatBg 18s ease-in-out infinite;
            animation-delay: -8s;
        }

        @keyframes floatBg {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(30px, -40px) scale(1.08); }
            66% { transform: translate(-20px, 30px) scale(0.96); }
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

        .nav-brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--text-primary);
        }

        .nav-brand-icon {
            width: 40px;
            height: 40px;
            border-radius: 12px;
            background: var(--gradient-1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .nav-brand:hover .nav-brand-icon {
            transform: rotate(-8deg) scale(1.08);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        .nav-brand-text {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -0.3px;
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .nav-links { display: flex; align-items: center; gap: 8px; }

        .nav-link {
            padding: 8px 18px;
            border-radius: 10px;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover { color: var(--primary); background: rgba(99, 102, 241, 0.06); }
        .nav-link.active { color: var(--primary); background: rgba(99, 102, 241, 0.1); }

        .nav-link-admin {
            padding: 8px 20px;
            background: var(--gradient-1);
            color: #fff !important;
            border-radius: 10px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.3);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .nav-link-admin:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(99, 102, 241, 0.4);
        }

        /* ========== Hero ========== */
        .hero {
            position: relative;
            z-index: 1;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 120px 24px 80px;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 20px;
            background: rgba(99, 102, 241, 0.08);
            border: 1px solid rgba(99, 102, 241, 0.15);
            border-radius: 50px;
            font-size: 13px;
            color: var(--primary);
            font-weight: 500;
            margin-bottom: 32px;
            animation: fadeInUp 0.8s ease forwards;
            opacity: 0;
        }

        .hero-badge-dot {
            width: 6px;
            height: 6px;
            background: var(--primary);
            border-radius: 50%;
            animation: pulse 2s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(1.6); }
        }

        .hero-title {
            font-size: clamp(44px, 7vw, 82px);
            font-weight: 800;
            line-height: 1.1;
            letter-spacing: -2px;
            margin-bottom: 24px;
            animation: fadeInUp 0.8s ease 0.15s forwards;
            opacity: 0;
        }

        .hero-title-line { display: block; }

        .hero-title-gradient {
            background: var(--gradient-1);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-subtitle {
            font-size: clamp(16px, 2vw, 20px);
            color: var(--text-secondary);
            max-width: 520px;
            line-height: 1.8;
            margin-bottom: 48px;
            animation: fadeInUp 0.8s ease 0.3s forwards;
            opacity: 0;
        }

        .hero-actions {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            justify-content: center;
            animation: fadeInUp 0.8s ease 0.45s forwards;
            opacity: 0;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 32px;
            background: var(--gradient-1);
            color: #fff;
            border-radius: 14px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            border: none;
            cursor: pointer;
            box-shadow: 0 8px 30px rgba(99, 102, 241, 0.3);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-primary::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent);
            opacity: 0;
            transition: opacity 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.02);
            box-shadow: 0 16px 40px rgba(99, 102, 241, 0.4);
        }

        .btn-primary:hover::before { opacity: 1; }

        .btn-ghost {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: var(--bg-card);
            color: var(--text-primary);
            border: 1.5px solid var(--border);
            border-radius: 14px;
            font-size: 15px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .btn-ghost:hover {
            border-color: var(--primary);
            color: var(--primary);
            background: rgba(99, 102, 241, 0.04);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.1);
        }

        .hero-scroll {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            color: var(--text-muted);
            font-size: 12px;
            letter-spacing: 2px;
            text-transform: uppercase;
            animation: fadeInUp 1s ease 1s forwards, float 3s ease-in-out infinite 1.5s;
            opacity: 0;
            text-decoration: none;
        }

        .scroll-line {
            width: 1px;
            height: 40px;
            background: linear-gradient(to bottom, var(--primary), transparent);
            animation: scrollLine 2s ease-in-out infinite;
        }

        @keyframes scrollLine {
            0% { transform: scaleY(0); transform-origin: top; }
            50% { transform: scaleY(1); transform-origin: top; }
            51% { transform: scaleY(1); transform-origin: bottom; }
            100% { transform: scaleY(0); transform-origin: bottom; }
        }

        /* ========== 文章列表 ========== */
        .articles-section {
            position: relative;
            z-index: 1;
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px 24px 120px;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 48px;
            animation: fadeInUp 0.8s ease forwards;
            opacity: 0;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .section-title-icon {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            background: var(--gradient-1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.25);
        }

        .section-count {
            padding: 6px 16px;
            background: rgba(99, 102, 241, 0.08);
            border: 1px solid rgba(99, 102, 241, 0.12);
            border-radius: 50px;
            font-size: 13px;
            color: var(--primary);
            font-weight: 500;
        }

        .articles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 24px;
        }

        .article-card {
            position: relative;
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 32px;
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            overflow: hidden;
            opacity: 0;
            transform: translateY(30px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        }

        .article-card.visible {
            opacity: 1;
            transform: translateY(0);
        }

        .article-card:hover {
            transform: translateY(-8px);
            border-color: rgba(99, 102, 241, 0.2);
            box-shadow: var(--shadow-hover);
            background: var(--bg-card-hover);
        }

        .card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .card-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            background: rgba(99, 102, 241, 0.08);
            border-radius: 8px;
            font-size: 12px;
            color: var(--primary);
            font-weight: 500;
        }

        .card-date { font-size: 12px; color: var(--text-muted); }

        .card-title {
            font-size: 18px;
            font-weight: 700;
            line-height: 1.45;
            margin-bottom: 12px;
            color: var(--text-primary);
            transition: color 0.3s;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .article-card:hover .card-title { color: var(--primary); }

        .card-excerpt {
            font-size: 14px;
            color: var(--text-secondary);
            line-height: 1.75;
            margin-bottom: 24px;
            flex-grow: 1;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 20px;
            border-top: 1px solid var(--border-light);
        }

        .card-author { display: flex; align-items: center; gap: 10px; }

        .card-author-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--gradient-2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
        }

        .card-author-name { font-size: 13px; font-weight: 500; color: var(--text-secondary); }

        .card-read-more {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: var(--primary);
            font-weight: 500;
            opacity: 0;
            transform: translateX(-10px);
            transition: all 0.3s ease;
        }

        .article-card:hover .card-read-more {
            opacity: 1;
            transform: translateX(0);
        }

        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 80px 20px;
            animation: fadeIn 0.6s ease;
        }

        .empty-icon { font-size: 64px; margin-bottom: 24px; opacity: 0.25; }
        .empty-state h3 { font-size: 20px; color: var(--text-secondary); margin-bottom: 8px; }
        .empty-state p { color: var(--text-muted); font-size: 14px; }

        /* ========== 底部 ========== */
        .footer {
            position: relative;
            z-index: 1;
            text-align: center;
            padding: 40px 24px 60px;
            border-top: 1px solid var(--border);
        }

        .footer-text { font-size: 14px; color: var(--text-muted); }
        .footer-text span { color: var(--primary); font-weight: 600; }

        /* ========== 动画 ========== */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
        @keyframes float {
            0%, 100% { transform: translateX(-50%) translateY(0); }
            50% { transform: translateX(-50%) translateY(-10px); }
        }

        /* ========== 响应式 ========== */
        @media (max-width: 768px) {
            .navbar { padding: 0 20px; }
            .nav-links { gap: 4px; }
            .nav-link { padding: 8px 12px; font-size: 13px; }
            .nav-link-admin { padding: 8px 14px; }
            .articles-grid { grid-template-columns: 1fr; }
            .hero { padding: 100px 20px 80px; }
            .hero-actions { flex-direction: column; align-items: center; }
            .section-header { flex-direction: column; align-items: flex-start; gap: 16px; }
        }
    </style>
</head>
<body>
    <!-- 装饰背景 -->
    <div class="bg-decoration">
        <div class="bg-circle bg-circle-1"></div>
        <div class="bg-circle bg-circle-2"></div>
        <div class="bg-circle bg-circle-3"></div>
    </div>

    <!-- 导航栏 -->
    <nav class="navbar" id="navbar">
        <a href="index.php" class="nav-brand">
            <div class="nav-brand-icon">&#10022;</div>
            <span class="nav-brand-text">许老师的小站</span>
        </a>
        <div class="nav-links">
            <a href="index.php" class="nav-link active">首页</a>
            <a href="main.php" class="nav-link nav-link-admin" target="_blank">后台管理</a>
        </div>
    </nav>

    <!-- Hero -->
    <section class="hero">
        <div class="hero-badge">
            <span class="hero-badge-dot"></span>
            <span>笔记与随笔</span>
        </div>
        <h1 class="hero-title">
            <span class="hero-title-line">记录思考，</span>
            <span class="hero-title-line hero-title-gradient">沉淀成长</span>
        </h1>
        <p class="hero-subtitle">
            在这里，每一次敲击键盘都是一次思维的碰撞，每一篇文章都是对知识的重新梳理。
        </p>
        <div class="hero-actions">
            <a href="#articles" class="btn-primary">
                <span>探索文章</span>
                <span>&#8595;</span>
            </a>
            <a href="main.php" class="btn-ghost" target="_blank">后台管理</a>
        </div>
        <a href="#articles" class="hero-scroll">
            <span>向下滚动</span>
            <div class="scroll-line"></div>
        </a>
    </section>

    <!-- 文章列表 -->
    <section class="articles-section" id="articles">
        <div class="section-header">
            <h2 class="section-title">
                <div class="section-title-icon">&#128221;</div>
                全部文章
            </h2>
            <?php
            include("db.php");
            $sql = "SELECT COUNT(*) as total FROM articles";
            $countResult = mysqli_query($conn, $sql);
            $countRow = mysqli_fetch_assoc($countResult);
            ?>
            <span class="section-count"><?php echo $countRow['total']; ?> 篇</span>
        </div>

        <div class="articles-grid">
            <?php
            $sql = "SELECT * FROM articles ORDER BY id DESC";
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) === 0) {
                echo '<div class="empty-state">
                    <div class="empty-icon">&#128579;</div>
                    <h3>暂无文章</h3>
                    <p>点击右上角「后台管理」添加你的第一篇文章吧</p>
                </div>';
            }

            while ($row = mysqli_fetch_assoc($result)) {
                $excerpt = mb_substr(strip_tags($row["content"]), 0, 80, 'utf-8');
                if (mb_strlen(strip_tags($row["content"]), 'utf-8') > 80) $excerpt .= '…';
                $authorInitial = mb_substr($row["author"], 0, 1, 'utf-8');
            ?>
            <a href="article.php?id=<?php echo $row["id"]; ?>" class="article-card">
                <div class="card-top">
                    <span class="card-tag">&#128196; 笔记</span>
                    <span class="card-date"><?php echo date('m/d', strtotime($row["time"])); ?></span>
                </div>
                <h3 class="card-title"><?php echo htmlspecialchars($row["title"]); ?></h3>
                <p class="card-excerpt"><?php echo htmlspecialchars($excerpt); ?></p>
                <div class="card-footer">
                    <div class="card-author">
                        <div class="card-author-avatar"><?php echo $authorInitial; ?></div>
                        <span class="card-author-name"><?php echo htmlspecialchars($row["author"]); ?></span>
                    </div>
                    <span class="card-read-more">阅读全文 &#8594;</span>
                </div>
            </a>
            <?php } ?>
        </div>
    </section>

    <!-- 底部 -->
    <footer class="footer">
        <p class="footer-text">
            &copy; <?php echo date('Y'); ?> <span>许老师的小站</span> &middot; 用心记录每一天
        </p>
    </footer>

    <script>
        const navbar = document.getElementById('navbar');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 50);
        }, { passive: true });

        const cards = document.querySelectorAll('.article-card');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), index * 80);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        cards.forEach(card => observer.observe(card));

        cards.forEach(card => {
            card.addEventListener('click', function(e) {
                const ripple = document.createElement('div');
                ripple.style.cssText = 'position:absolute;border-radius:50%;background:rgba(99,102,241,0.1);transform:scale(0);animation:rippleOut 0.6s ease-out forwards;pointer-events:none;';
                const rect = this.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
                ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
                this.appendChild(ripple);
                setTimeout(() => ripple.remove(), 600);
            });
        });

        const s = document.createElement('style');
        s.textContent = '@keyframes rippleOut { to { transform:scale(4); opacity:0; } }';
        document.head.appendChild(s);
    </script>
</body>
</html>
