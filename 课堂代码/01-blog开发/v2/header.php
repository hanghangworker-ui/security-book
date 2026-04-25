<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <?php
    @session_start();
    if (!isset($_SESSION["username"])) {
        echo "<script>alert('请先登录');location.href='login.php'</script>";
        exit;
    }
    $page = isset($page) ? $page : '';
    $pageTitle = isset($pageTitle) ? $pageTitle : '网站后台管理';

    if (isset($_GET["logout"])) {
        session_destroy();
        echo "<script>alert('退出成功');location.href='login.php'</script>";
    }
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'PingFang SC', 'Microsoft YaHei', 'Segoe UI', Arial, sans-serif;
            background: #fafbfc;
            color: #374151;
            min-height: 100vh;
            letter-spacing: 0.3px;
            line-height: 1.6;
        }

        /* 顶部导航 */
        .header {
            background: #ffffff;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            border-bottom: 1px solid #e5e7eb;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 100;
        }

        .header h1 {
            font-size: 18px;
            color: #1f2937;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .header .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #6b7280;
            font-size: 14px;
        }

        .header .user-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #3b82f6;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
            font-size: 13px;
        }

        /* 侧边栏 */
        .sidebar {
            width: 220px;
            background: #ffffff;
            color: #374151;
            position: fixed;
            left: 0;
            top: 60px;
            bottom: 0;
            padding: 20px 0;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 14px;
            color: #6b7280;
            text-decoration: none;
            padding: 12px 24px;
            font-size: 14px;
            transition: all 0.2s ease;
            margin: 4px 12px;
            border-radius: 8px;
            letter-spacing: 0.5px;
        }

        .sidebar a:hover {
            background: #f3f4f6;
            color: #374151;
        }

        .sidebar a.active {
            background: #eff6ff;
            color: #3b82f6;
            font-weight: 500;
        }

        .sidebar a .icon {
            font-size: 17px;
            width: 22px;
            text-align: center;
        }

        /* 退出登录 */
        .sidebar .logout {
            margin-top: auto;
            border-top: 1px solid #e5e7eb;
            padding-top: 16px;
            margin-left: 0;
            margin-right: 0;
        }

        .sidebar .logout:hover {
            background: #fef2f2;
            color: #ef4444;
        }

        /* 主内容区 */
        .main-content {
            margin-left: 220px;
            margin-top: 60px;
            padding: 32px 40px;
            min-height: calc(100vh - 60px);
        }

        /* 欢迎区域（main.php） */
        .welcome-section {
            margin-bottom: 28px;
        }

        .welcome-section h2 {
            font-size: 24px;
            color: #111827;
            margin-bottom: 6px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .welcome-section p {
            color: #9ca3af;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        /* 统计卡片（main.php） */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 28px;
        }

        .stat-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 24px;
            transition: all 0.25s ease;
        }

        .stat-card:hover {
            border-color: #d1d5db;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.04);
        }

        .stat-card .card-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            margin-bottom: 16px;
        }

        .stat-card.visitors .card-icon {
            background: #eff6ff;
        }

        .stat-card.memory .card-icon {
            background: #ecfdf5;
        }

        .stat-card.cpu .card-icon {
            background: #fef3c7;
        }

        .stat-card.site .card-icon {
            background: #fef2f2;
        }

        .stat-card .stat-label {
            font-size: 13px;
            color: #9ca3af;
            margin-bottom: 6px;
            letter-spacing: 0.5px;
        }

        .stat-card .stat-value {
            font-size: 28px;
            font-weight: 600;
            color: #111827;
            letter-spacing: 0.5px;
        }

        .stat-card .stat-unit {
            font-size: 14px;
            color: #6b7280;
            font-weight: normal;
        }

        /* 内容卡片（main.php） */
        .content-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 28px;
            margin-bottom: 20px;
        }

        .content-card h3 {
            font-size: 16px;
            color: #111827;
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 1px solid #f3f4f6;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .info-list {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 16px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px;
            background: #f9fafb;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .info-item:hover {
            background: #f3f4f6;
        }

        .info-item .info-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: #eff6ff;
            color: #3b82f6;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        .info-item .info-text h4 {
            font-size: 14px;
            color: #374151;
            margin-bottom: 2px;
            font-weight: 500;
            letter-spacing: 0.3px;
        }

        .info-item .info-text p {
            font-size: 13px;
            color: #9ca3af;
            letter-spacing: 0.3px;
        }

        /* 页面头部 */
        .page-header {
            margin-bottom: 28px;
        }

        .page-header h2 {
            font-size: 24px;
            color: #111827;
            font-weight: 600;
            letter-spacing: 0.5px;
            margin-bottom: 6px;
        }

        .page-header p {
            color: #9ca3af;
            font-size: 14px;
            letter-spacing: 0.5px;
        }

        .page-header-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #3b82f6;
            color: #fff;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s ease;
            letter-spacing: 0.5px;
        }

        .btn-add:hover {
            background: #2563eb;
        }

        /* 表格容器 */
        .table-container {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        thead {
            background: #f9fafb;
        }

        th {
            text-align: left;
            padding: 16px 20px;
            font-size: 13px;
            font-weight: 600;
            color: #6b7280;
            letter-spacing: 0.8px;
            border-bottom: 1px solid #e5e7eb;
            white-space: nowrap;
        }

        td {
            padding: 14px 16px;
            font-size: 14px;
            color: #374151;
            border-bottom: 1px solid #f3f4f6;
            vertical-align: middle;
            letter-spacing: 0.3px;
        }

        tbody tr {
            transition: background 0.15s ease;
        }

        tbody tr:hover {
            background: #f9fafb;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        /* 文章列表表格列宽 */
        .articles-table th:nth-child(1) {
            width: 10%;
        }

        .articles-table th:nth-child(2) {
            width: 30%;
        }

        .articles-table th:nth-child(3) {
            width: 15%;
        }

        .articles-table th:nth-child(4) {
            width: 20%;
        }

        .articles-table th:nth-child(5) {
            width: 25%;
        }

        /* 用户列表表格列宽 */
        .users-table th:nth-child(1) {
            width: 8%;
        }

        .users-table th:nth-child(2) {
            width: 15%;
        }

        .users-table th:nth-child(3) {
            width: 18%;
        }

        .users-table th:nth-child(4) {
            width: 34%;
        }

        .users-table th:nth-child(5) {
            width: 25%;
        }

        .users-table td:nth-child(1),
        .users-table td:nth-child(2),
        .users-table td:nth-child(3),
        .users-table td:nth-child(4) {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* 操作按钮 */
        .action-btns {
            display: flex;
            gap: 8px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 13px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.15s ease;
            letter-spacing: 0.3px;
        }

        .btn-edit {
            background: #eff6ff;
            color: #3b82f6;
        }

        .btn-edit:hover {
            background: #3b82f6;
            color: #fff;
        }

        .btn-delete {
            background: #fef2f2;
            color: #ef4444;
        }

        .btn-delete:hover {
            background: #ef4444;
            color: #fff;
        }

        /* 表单卡片 */
        .form-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 32px;
            max-width: 720px;
        }

        .form-card-sm {
            max-width: 520px;
        }

        .form-group {
            margin-bottom: 24px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
            letter-spacing: 0.3px;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 16px;
            font-size: 14px;
            font-family: inherit;
            color: #374151;
            background: #ffffff;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            outline: none;
            transition: all 0.2s ease;
            letter-spacing: 0.3px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: #9ca3af;
        }

        .form-group textarea {
            min-height: 240px;
            resize: vertical;
            line-height: 1.6;
        }

        .form-hint {
            font-size: 13px;
            color: #9ca3af;
            margin-top: 6px;
        }

        .btn-group {
            display: flex;
            gap: 12px;
            margin-top: 32px;
        }

        .btn-group .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            font-size: 14px;
            font-weight: 500;
            font-family: inherit;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s ease;
            letter-spacing: 0.5px;
            text-decoration: none;
        }

        .btn-primary {
            background: #3b82f6;
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background: #2563eb;
        }

        .btn-secondary {
            background: #ffffff;
            color: #374151;
            border: 1px solid #d1d5db;
        }

        .btn-secondary:hover {
            background: #f9fafb;
            border-color: #9ca3af;
        }

        /* 密码显示 */
        .password-masked {
            font-family: inherit;
            color: #374151;
            letter-spacing: 1px;
        }

        /* 响应式 */
        @media (max-width: 900px) {
            .sidebar {
                width: 64px;
            }

            .sidebar .nav-text {
                display: none;
            }

            .sidebar a {
                justify-content: center;
                padding: 12px;
                margin: 4px 8px;
            }

            .main-content {
                margin-left: 64px;
            }
        }

        @media (max-width: 600px) {
            .sidebar {
                display: none;
            }

            .main-content {
                margin-left: 0;
                padding: 24px;
            }

            .header {
                padding: 0 20px;
            }

            .header h1 {
                font-size: 15px;
            }

            .page-header-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            th,
            td {
                padding: 12px 16px;
            }

            .action-btns {
                flex-direction: column;
                gap: 6px;
            }

            .form-card {
                padding: 24px;
            }

            .btn-group {
                flex-direction: column;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>
    <header class="header">
        <h1>网站后台管理</h1>
        <div class="user-info">
            <span>欢迎回来</span>
            <div class="user-avatar">管</div>
        </div>
    </header>

    <nav class="sidebar">
        <a href="main.php" class="<?php echo $page == 'main' ? 'active' : ''; ?>">
            <span class="icon">&#128202;</span>
            <span class="nav-text">网站信息</span>
        </a>
        <a href="articles_list.php" class="<?php echo $page == 'articles' ? 'active' : ''; ?>">
            <span class="icon">&#128221;</span>
            <span class="nav-text">文章管理</span>
        </a>
        <a href="users_list.php" class="<?php echo $page == 'users' ? 'active' : ''; ?>">
            <span class="icon">&#128101;</span>
            <span class="nav-text">用户管理</span>
        </a>
        <a href="?logout" class="logout">
            <span class="icon">&#128682;</span>
            <span class="nav-text">退出登录</span>
        </a>
    </nav>