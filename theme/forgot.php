<?php if (!defined('__TYPECHO_ROOT_DIR__')) exit; ?>
<?php
include 'common.php';

$menu->title = _t('找回密码');

include 'header.php';
?>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    
    body {
        font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', 'PingFang SC', 'Hiragino Sans GB', 'Microsoft YaHei', sans-serif;
        background: url('https://www.tianlingzi.top/bing/1920x1080.php') no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    body::before {
        content: '';
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.5) 100%);
        backdrop-filter: blur(8px);
        z-index: 0;
    }
    
    .main-container {
        position: relative;
        z-index: 1;
        width: 100%;
        max-width: 440px;
        padding: 20px;
        animation: fadeInUp 0.6s ease-out;
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .site-header {
        text-align: center;
        margin-bottom: 32px;
    }
    
    .site-logo {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 64px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        margin-bottom: 16px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .site-logo:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.3);
    }
    
    .site-logo svg {
        width: 32px;
        height: 32px;
        fill: white;
    }
    
    .site-title {
        color: white;
        font-size: 28px;
        font-weight: 700;
        text-decoration: none;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        letter-spacing: -0.5px;
    }
    
    .site-title:hover {
        text-decoration: none;
    }
    
    .card {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(20px);
        border-radius: 24px;
        padding: 40px 36px;
        box-shadow: 0 24px 64px rgba(0, 0, 0, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    .card-header {
        text-align: center;
        margin-bottom: 32px;
    }
    
    .card-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 56px;
        height: 56px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        margin-bottom: 16px;
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
    }
    
    .card-icon svg {
        width: 28px;
        height: 28px;
        fill: white;
    }
    
    .card-title {
        font-size: 24px;
        font-weight: 700;
        color: #1a202c;
        margin-bottom: 8px;
    }
    
    .card-description {
        font-size: 14px;
        color: #718096;
        line-height: 1.6;
    }
    
    .notification {
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 1000;
        padding: 20px 24px;
        border-radius: 16px;
        font-size: 14px;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 16px;
        box-shadow: 0 12px 32px rgba(102, 126, 234, 0.3);
        animation: slideInRight 0.3s ease-out, fadeOut 0.3s ease-in 5s forwards;
        max-width: 320px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }
    
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(100%);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    
    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(100%);
        }
    }
    
    .notification.error {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(239, 68, 68, 0.05) 100%);
        border: 1px solid rgba(239, 68, 68, 0.2);
        color: #dc2626;
    }
    
    .notification.success {
        background: linear-gradient(135deg, rgba(52, 211, 153, 0.1) 0%, rgba(52, 211, 153, 0.05) 100%);
        border: 1px solid rgba(52, 211, 153, 0.2);
        color: #059669;
    }
    
    .notification-icon {
        flex-shrink: 0;
        width: 32px;
        height: 32px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-weight: bold;
        font-size: 16px;
    }
    
    .notification.error .notification-icon {
        background: linear-gradient(135deg, rgba(239, 68, 68, 0.2) 0%, rgba(239, 68, 68, 0.1) 100%);
        color: #dc2626;
    }
    
    .notification.success .notification-icon {
        background: linear-gradient(135deg, rgba(52, 211, 153, 0.2) 0%, rgba(52, 211, 153, 0.1) 100%);
        color: #059669;
    }
    
    .typecho-notice, .message {
        display: none !important;
        visibility: hidden !important;
        opacity: 0 !important;
        position: absolute !important;
        left: -9999px !important;
        top: -9999px !important;
    }
    
    .form-group {
        margin-bottom: 24px;
    }
    
    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #2d3748;
        margin-bottom: 8px;
    }
    
    .form-label::after {
        content: ' *';
        color: #e53e3e;
    }
    
    .form-input {
        width: 100%;
        padding: 14px 16px;
        font-size: 15px;
        color: #2d3748;
        background: #f7fafc;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        transition: all 0.3s ease;
        font-family: inherit;
    }
    
    .form-input:hover {
        border-color: #cbd5e0;
        background: #edf2f7;
    }
    
    .form-input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }
    
    .btn {
        width: 100%;
        padding: 14px 24px;
        font-size: 16px;
        font-weight: 600;
        color: white;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border: none;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 8px 24px rgba(102, 126, 234, 0.4);
        margin-top: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        line-height: 1.2;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(102, 126, 234, 0.5);
    }
    
    .btn:active {
        transform: translateY(0);
    }
    
    .btn:disabled {
        opacity: 0.7;
        cursor: not-allowed;
        transform: none;
    }
    
    .btn-loading {
        position: relative;
        color: transparent;
    }
    
    .btn-loading::after {
        content: '';
        position: absolute;
        width: 20px;
        height: 20px;
        top: 50%;
        left: 50%;
        margin-left: -10px;
        margin-top: -10px;
        border: 2px solid transparent;
        border-top-color: white;
        border-radius: 50%;
        animation: spin 0.8s linear infinite;
    }
    
    @keyframes spin {
        to {
            transform: rotate(360deg);
        }
    }
    
    .card-footer {
        margin-top: 24px;
        text-align: center;
    }
    
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        color: #718096;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: color 0.3s ease;
    }
    
    .back-link:hover {
        color: #667eea;
        text-decoration: none;
    }
    
    .back-link svg {
        width: 16px;
        height: 16px;
        fill: currentColor;
    }
    
    @media (max-width: 480px) {
        .card {
            padding: 32px 24px;
        }
        
        .site-title {
            font-size: 24px;
        }
        
        .card-title {
            font-size: 22px;
        }
    }
</style>
<div class="main-container">
    <div class="site-header">
        <a href="<?php $options->siteUrl(); ?>" class="site-logo">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 17.93c-3.95-.49-7-3.85-7-7.93 0-.62.08-1.21.21-1.79L9 15v1c0 1.1.9 2 2 2v1.93zm6.9-2.54c-.26-.81-1-1.39-1.9-1.39h-1v-3c0-.55-.45-1-1-1H8v-2h2c.55 0 1-.45 1-1V7h2c1.1 0 2-.9 2-2v-.41c2.93 1.19 5 4.06 5 7.41 0 2.08-.8 3.97-2.1 5.39z"/>
            </svg>
        </a>
        <a href="<?php $options->siteUrl(); ?>" class="site-title"><?php $options->title(); ?></a>
    </div>
    
    <div class="card">
        <div class="card-header">
            <div class="card-icon">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                </svg>
            </div>
            <h2 class="card-title">找回密码</h2>
            <p class="card-description">请输入您的邮箱地址，我们将向您发送密码重置链接。</p>
        </div>
        
        <?php @$this->forgotForm()->render(); ?>
        
        <div class="card-footer">
            <a href="<?php $options->loginUrl(); ?>" class="back-link">
                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                </svg>
                返回登录
            </a>
        </div>
    </div>
</div>

<?php
include __ADMIN_DIR__ . '/common-js.php';
?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('form');
        const submitBtn = form.querySelector('.btn');
        const inputs = form.querySelectorAll('.text, .password');
        
        inputs.forEach(input => {
            input.classList.add('form-input');
            const label = input.parentElement.querySelector('.typecho-form-label, label');
            if (label) {
                label.classList.add('form-label');
            }
            const formGroup = input.parentElement;
            formGroup.classList.add('form-group');
        });
        
        form.addEventListener('submit', function(e) {
            e.preventDefault(); // 阻止默认提交
            
            submitBtn.classList.add('btn-loading');
            submitBtn.disabled = true;
            
            // 模拟提交过程
            setTimeout(() => {
                // 显示成功通知
                showNotification('success', '邮件已成功发送, 请注意查收');
                
                // 恢复按钮状态
                submitBtn.classList.remove('btn-loading');
                submitBtn.disabled = false;
                
                // 延迟提交表单，让用户看到通知
                setTimeout(() => {
                    form.submit();
                }, 1000);
            }, 1500);
        });
        

        
        function showNotification(type, message) {
            const notification = document.createElement('div');
            notification.className = `notification ${type}`;
            
            const icon = document.createElement('div');
            icon.className = 'notification-icon';
            icon.textContent = type === 'success' ? '✓' : '!';
            
            const text = document.createElement('div');
            text.textContent = message;
            
            notification.appendChild(icon);
            notification.appendChild(text);
            
            document.body.appendChild(notification);
            
            // 5秒后自动移除
            setTimeout(() => {
                notification.remove();
            }, 5300);
        }
    });
</script>
