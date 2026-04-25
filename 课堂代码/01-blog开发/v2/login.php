<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>欢迎登录</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
            font-family: 'Segoe UI', 'PingFang SC', 'Microsoft YaHei', sans-serif;
            overflow: hidden;
        }

        /* 装饰背景 */
        .bg-decoration {
            position: fixed;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            z-index: 0;
            animation: float 8s ease-in-out infinite;
        }

        .bg-decoration:nth-child(1) {
            width: 400px;
            height: 400px;
            background: rgba(102, 126, 234, 0.6);
            top: -100px;
            left: -100px;
            animation-delay: 0s;
        }

        .bg-decoration:nth-child(2) {
            width: 300px;
            height: 300px;
            background: rgba(240, 147, 251, 0.5);
            bottom: -50px;
            right: -50px;
            animation-delay: -2s;
        }

        .bg-decoration:nth-child(3) {
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.3);
            top: 50%;
            right: 10%;
            animation-delay: -4s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) scale(1);
            }

            25% {
                transform: translate(20px, -20px) scale(1.05);
            }

            50% {
                transform: translate(0, -30px) scale(1);
            }

            75% {
                transform: translate(-20px, -10px) scale(1.03);
            }
        }

        /* 登录卡片 */
        .login-card {
            position: relative;
            z-index: 1;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 48px 40px;
            width: 420px;
            max-width: 90vw;
            box-shadow:
                0 25px 50px -12px rgba(0, 0, 0, 0.25),
                0 0 0 1px rgba(255, 255, 255, 0.5) inset;
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(40px) scale(0.95);
            }

            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        /* 标题 */
        .login-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .login-title h1 {
            font-size: 28px;
            font-weight: 600;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .login-title p {
            font-size: 14px;
            color: #6b7280;
        }

        /* 输入框容器 */
        .input-group {
            position: relative;
            margin-bottom: 24px;
        }

        .input-group input {
            width: 100%;
            padding: 16px 20px;
            font-size: 16px;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            outline: none;
            background: #f9fafb;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .input-group input::placeholder {
            color: #9ca3af;
            transition: all 0.3s ease;
        }

        .input-group input:focus {
            border-color: #667eea;
            background: #ffffff;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
        }

        .input-group input:focus::placeholder {
            opacity: 0.5;
            transform: translateX(4px);
        }

        /* 输入框图标 */
        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 18px;
            color: #9ca3af;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .input-group input:focus~.input-icon {
            color: #667eea;
        }

        .input-group input {
            padding-left: 48px;
        }

        /* 记住我 & 忘记密码 */
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 28px;
        }

        .remember-me {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
        }

        .remember-me input[type="checkbox"] {
            display: none;
        }

        .checkmark {
            width: 18px;
            height: 18px;
            border: 2px solid #d1d5db;
            border-radius: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .remember-me:hover .checkmark {
            border-color: #667eea;
        }

        .remember-me input:checked+.checkmark {
            background: #667eea;
            border-color: #667eea;
        }

        .checkmark::after {
            content: '✓';
            font-size: 12px;
            color: white;
            opacity: 0;
            transform: scale(0);
            transition: all 0.2s ease;
        }

        .remember-me input:checked+.checkmark::after {
            opacity: 1;
            transform: scale(1);
        }

        .remember-me span {
            font-size: 14px;
            color: #6b7280;
        }

        .forgot-password {
            font-size: 14px;
            color: #667eea;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .forgot-password:hover {
            color: #764ba2;
        }

        /* 登录按钮 */
        .login-btn {
            width: 100%;
            padding: 16px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 12px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px -5px rgba(102, 126, 234, 0.5);
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:active {
            transform: translateY(0);
            box-shadow: 0 5px 15px -3px rgba(102, 126, 234, 0.4);
        }

        /* 注册链接 */
        .signup-link {
            text-align: center;
            margin-top: 28px;
            font-size: 14px;
            color: #6b7280;
        }

        .signup-link a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .signup-link a:hover {
            color: #764ba2;
        }

        /* 分隔线 */
        .divider {
            display: flex;
            align-items: center;
            margin: 28px 0;
            gap: 16px;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
        }

        .divider span {
            font-size: 12px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* 社交登录 */
        .social-login {
            display: flex;
            gap: 12px;
        }

        .social-btn {
            flex: 1;
            padding: 12px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            background: white;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            font-size: 14px;
            color: #6b7280;
            transition: all 0.3s ease;
        }

        .social-btn:hover {
            border-color: #667eea;
            background: #f9fafb;
            transform: translateY(-2px);
        }

        .social-btn svg {
            width: 20px;
            height: 20px;
        }
    </style>
</head>

<body>
    <!-- 装饰背景 -->
    <div class="bg-decoration"></div>
    <div class="bg-decoration"></div>
    <div class="bg-decoration"></div>

    <div class="login-card">
        <div class="login-title">
            <h1>欢迎登录</h1>
            <p>请输入您的账号信息</p>
        </div>

        <form action="users.php" method="POST">
            <!-- GET提交方式，所有的信息都在网址中 -->
            <!-- POST提交方式，所有的信息都在请求体中 -->
            <div class="input-group">
                <input type="text" placeholder="用户名" name="username" required>
                <span class="input-icon">👤</span>
            </div>

            <div class="input-group">
                <input type="text" placeholder="密码" name="password" required>
                <span class="input-icon">🔒</span>
            </div>

            <div class="form-options">
                <label class="remember-me">
                    <input type="checkbox" name="remember">
                    <span class="checkmark"></span>
                    <span>记住我</span>
                </label>
                <a href="#" class="forgot-password">忘记密码？</a>
            </div>

            <input type="submit" class="login-btn" name="login" value="登 录">
        </form>

        <div class="signup-link">
            还没有账号？<a href="register.php">立即注册</a>
        </div>

    </div>
</body>

</html>