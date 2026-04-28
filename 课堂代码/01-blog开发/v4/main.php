<?php
$pageTitle = '网站后台管理 - 网站信息';
$page = 'main';
include_once("header.php");
?>

<main class="main-content">
    <div class="welcome-section">
        <h2>仪表盘</h2>
        <p>实时监控网站运行状态</p>
    </div>
    <?php
    // 获取服务器的内存占用
    //$memoryUsage = exec('powershell -c "$os=Get-CimInstance Win32_OperatingSystem;$pct=[math]::Round(($os.TotalVisibleMemorySize-$os.FreePhysicalMemory)*100/$os.TotalVisibleMemorySize,1);echo $pct"');
    // 目前用随机数代替
    $memoryUsage = mt_rand(30, 60);

    // 获取服务器的CPU占用
    //$cpuUsage = exec('powershell -c "(Get-CimInstance Win32_Processor).LoadPercentage"');
    $cpuUsage = mt_rand(30, 60);
    ?>

    <div class="stats-grid">
        <div class="stat-card visitors">
            <div class="card-icon">👥</div>
            <div class="stat-label">今日访客</div>
            <div class="stat-value">1000</div>
        </div>
        <div class="stat-card memory">
            <div class="card-icon">💾</div>
            <div class="stat-label">服务内存占用</div>
            <div class="stat-value"><?php echo $memoryUsage; ?><span class="stat-unit">%</span></div>
        </div>
        <div class="stat-card cpu">
            <div class="card-icon">⚙️</div>
            <div class="stat-label">服务器 CPU 占用</div>
            <div class="stat-value"><?php echo $cpuUsage; ?><span class="stat-unit">%</span></div>
        </div>
        <div class="stat-card site">
            <div class="card-icon">🌐</div>
            <div class="stat-label">站点名称</div>
            <div class="stat-value" style="font-size: 20px;">许老师的小站</div>
        </div>
    </div>

    <div class="content-card">
        <h3>快速信息</h3>
        <div class="info-list">
            <div class="info-item">
                <div class="info-icon">🏠</div>
                <div class="info-text">
                    <h4>站点状态</h4>
                    <p>运行正常</p>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon">🕐</div>
                <div class="info-text">
                    <h4>系统时间</h4>
                    <p id="current-time">加载中...</p>
                </div>
            </div>
            <div class="info-item">
                <div class="info-icon">📅</div>
                <div class="info-text">
                    <h4>系统日期</h4>
                    <p id="current-date">加载中...</p>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function updateTime() {
        const now = new Date();
        const timeStr = now.toLocaleTimeString('zh-CN', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        const dateStr = now.toLocaleDateString('zh-CN', { year: 'numeric', month: 'long', day: 'numeric', weekday: 'long' });
        document.getElementById('current-time').textContent = timeStr;
        document.getElementById('current-date').textContent = dateStr;
    }
    updateTime();
    setInterval(updateTime, 1000);
</script>
</body>

</html>