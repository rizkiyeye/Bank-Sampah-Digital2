<?php
require_once 'config.php';

// Start session only if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'] ?? 'login';
    
    if ($action === 'register') {
        // Handle registration
        $nama_lengkap = trim($_POST['nama_lengkap'] ?? '');
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm_password = trim($_POST['confirm_password'] ?? '');
        
        if (empty($nama_lengkap) || empty($username) || empty($password) || empty($confirm_password)) {
            echo "Semua field harus diisi";
            exit;
        }
        
        if ($password !== $confirm_password) {
            echo "Password dan konfirmasi password tidak cocok";
            exit;
        }
        
        try {
            // Check if username exists
            $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            
            if ($stmt->rowCount() > 0) {
                echo "Username sudah digunakan";
                exit;
            }
            
            // Insert new user
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("INSERT INTO users (nama_lengkap, username, password, created_at) VALUES (?, ?, ?, NOW())");
            $stmt->execute([$nama_lengkap, $username, $hashed_password]);
            
            echo "success";
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        
    } else {
        // Handle login
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');
        
        if (empty($username) || empty($password)) {
            echo "Username dan password harus diisi";
            exit;
        }
        
        try {
            $stmt = $conn->prepare("SELECT id, username, password, nama_lengkap FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
                
                echo "success";
            } else {
                echo "Username atau password salah";
            }
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
} else {
    // Show login/register form
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login/Register - Bank Sampah Digital</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    body::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" patternUnits="userSpaceOnUse" width="100" height="100"><circle cx="25" cy="25" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="%23ffffff" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="%23ffffff" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
        pointer-events: none;
    }

    .auth-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 40px;
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.2);
        width: 100%;
        max-width: 420px;
        position: relative;
        z-index: 1;
        margin: 0 auto;
    }

    .auth-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .auth-header h1 {
        color: #2d3748;
        margin-bottom: 8px;
        font-weight: 700;
        font-size: 28px;
    }

    .auth-header p {
        color: #718096;
        font-size: 14px;
        font-weight: 400;
    }

    .tab-container {
        display: flex;
        margin-bottom: 30px;
        background: #f7fafc;
        border-radius: 12px;
        padding: 4px;
    }

    .tab {
        flex: 1;
        padding: 12px 16px;
        text-align: center;
        cursor: pointer;
        border-radius: 8px;
        font-weight: 500;
        font-size: 14px;
        color: #718096;
        transition: all 0.3s ease;
    }

    .tab.active {
        background: #667eea;
        color: white;
        box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
    }

    .form-group {
        margin-bottom: 20px;
        width: 100%;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #4a5568;
        font-weight: 500;
        font-size: 14px;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%;
        padding: 14px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 16px;
        font-family: 'Poppins', sans-serif;
        transition: all 0.3s ease;
        background: #ffffff;
    }

    input:focus {
        outline: none;
        border-color: #667eea;
        box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        transform: translateY(-1px);
    }

    input:hover {
        border-color: #cbd5e0;
    }

    .btn {
        width: 100%;
        padding: 14px 16px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn:hover:before {
        left: 100%;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
    }

    .btn:active {
        transform: translateY(0px);
    }

    .auth-footer {
        text-align: center;
        margin-top: 25px;
    }

    .auth-footer a {
        color: #667eea;
        text-decoration: none;
        font-weight: 500;
        font-size: 14px;
        transition: color 0.3s ease;
    }

    .auth-footer a:hover {
        color: #5a67d8;
    }

    .alert {
        padding: 12px 16px;
        margin-bottom: 20px;
        border-radius: 8px;
        display: none;
        font-size: 14px;
        font-weight: 500;
    }

    .alert.error {
        background: #fed7d7;
        color: #c53030;
        border: 1px solid #feb2b2;
    }

    .alert.success {
        background: #c6f6d5;
        color: #2d7d32;
        border: 1px solid #9ae6b4;
    }

    .form-container {
        display: none;
    }

    .form-container.active {
        display: block;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Loading state */
    .btn.loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .btn.loading:after {
        content: '';
        position: absolute;
        width: 16px;
        height: 16px;
        margin: auto;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    /* Responsive */
    @media (max-width: 480px) {
        .auth-container {
            margin: 20px;
            padding: 30px 25px;
        }

        .auth-header h1 {
            font-size: 24px;
        }
    }
    </style>
</head>

<body>
    <div class="auth-container">
        <div class="auth-header">
            <h1 id="form-title">Masuk</h1>
            <p id="form-subtitle">Masuk ke akun Bank Sampah Digital Anda</p>
        </div>

        <div class="tab-container">
            <div class="tab active" data-tab="login">Masuk</div>
            <div class="tab" data-tab="register">Daftar</div>
        </div>

        <div id="alert" class="alert"></div>

        <div id="login-form" class="form-container active">
            <form id="loginForm">
                <div class="form-group">
                    <label for="login-username">Username</label>
                    <input type="text" id="login-username" name="username" required autocomplete="username">
                </div>

                <div class="form-group">
                    <label for="login-password">Password</label>
                    <input type="password" id="login-password" name="password" required autocomplete="current-password">
                </div>

                <button type="submit" class="btn" id="loginBtn">Masuk</button>
            </form>
        </div>

        <div id="register-form" class="form-container">
            <form id="registerForm">
                <div class="form-group">
                    <label for="register-nama">Nama Lengkap</label>
                    <input type="text" id="register-nama" name="nama_lengkap" required autocomplete="name">
                </div>

                <div class="form-group">
                    <label for="register-username">Username</label>
                    <input type="text" id="register-username" name="username" required autocomplete="username">
                </div>

                <div class="form-group">
                    <label for="register-password">Password</label>
                    <input type="password" id="register-password" name="password" required autocomplete="new-password">
                </div>

                <div class="form-group">
                    <label for="register-confirm">Konfirmasi Password</label>
                    <input type="password" id="register-confirm" name="confirm_password" required
                        autocomplete="new-password">
                </div>

                <button type="submit" class="btn" id="registerBtn">Daftar</button>
            </form>
        </div>

        <div class="auth-footer">
            <a href="index.php">← Kembali ke Beranda</a>
        </div>
    </div>

    <script>
    // Tab switching
    document.querySelectorAll('.tab').forEach(tab => {
        tab.addEventListener('click', function() {
            const tabName = this.getAttribute('data-tab');

            // Update tabs
            document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
            this.classList.add('active');

            // Update forms
            document.querySelectorAll('.form-container').forEach(f => f.classList.remove('active'));
            document.getElementById(`${tabName}-form`).classList.add('active');

            // Update title
            const title = document.getElementById('form-title');
            const subtitle = document.getElementById('form-subtitle');

            if (tabName === 'login') {
                title.textContent = 'Masuk';
                subtitle.textContent = 'Masuk ke akun Bank Sampah Digital Anda';
            } else {
                title.textContent = 'Daftar';
                subtitle.textContent = 'Buat akun Bank Sampah Digital baru';
            }

            // Clear alerts
            hideAlert();
        });
    });

    // Login form
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const loginBtn = document.getElementById('loginBtn');
        const username = document.getElementById('login-username').value.trim();
        const password = document.getElementById('login-password').value;

        if (!username || !password) {
            showAlert('Username dan password harus diisi', 'error');
            return;
        }

        // Show loading state
        loginBtn.classList.add('loading');
        loginBtn.textContent = 'Memproses...';

        fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `username=${encodeURIComponent(username)}&password=${encodeURIComponent(password)}&action=login`
            })
            .then(response => response.text())
            .then(data => {
                loginBtn.classList.remove('loading');
                loginBtn.textContent = 'Masuk';

                if (data.trim() === 'success') {
                    showAlert('Login berhasil! Mengalihkan...', 'success');
                    setTimeout(() => {
                        window.location.href = 'index.php';
                    }, 1500);
                } else {
                    showAlert(data, 'error');
                }
            })
            .catch(error => {
                loginBtn.classList.remove('loading');
                loginBtn.textContent = 'Masuk';
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                console.error('Error:', error);
            });
    });

    // Register form
    document.getElementById('registerForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const registerBtn = document.getElementById('registerBtn');
        const namaLengkap = document.getElementById('register-nama').value.trim();
        const username = document.getElementById('register-username').value.trim();
        const password = document.getElementById('register-password').value;
        const confirmPassword = document.getElementById('register-confirm').value;

        // Client-side validation
        if (!namaLengkap || !username || !password || !confirmPassword) {
            showAlert('Semua field harus diisi', 'error');
            return;
        }

        if (password !== confirmPassword) {
            showAlert('Password dan konfirmasi password tidak cocok', 'error');
            return;
        }

        if (password.length < 6) {
            showAlert('Password minimal 6 karakter', 'error');
            return;
        }

        // Show loading state
        registerBtn.classList.add('loading');
        registerBtn.textContent = 'Memproses...';

        const formData = {
            nama_lengkap: namaLengkap,
            username: username,
            password: password,
            confirm_password: confirmPassword,
            action: 'register'
        };

        fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: Object.keys(formData)
                    .map(key => `${key}=${encodeURIComponent(formData[key])}`)
                    .join('&')
            })
            .then(response => response.text())
            .then(data => {
                registerBtn.classList.remove('loading');
                registerBtn.textContent = 'Daftar';

                if (data.trim() === 'success') {
                    showAlert('Registrasi berhasil! Silakan login.', 'success');
                    // Switch to login tab after 2 seconds
                    setTimeout(() => {
                        document.querySelector('.tab[data-tab="login"]').click();
                        // Pre-fill username
                        document.getElementById('login-username').value = username;
                        // Clear register form
                        document.getElementById('registerForm').reset();
                    }, 1500);
                } else {
                    showAlert(data, 'error');
                }
            })
            .catch(error => {
                registerBtn.classList.remove('loading');
                registerBtn.textContent = 'Daftar';
                showAlert('Terjadi kesalahan. Silakan coba lagi.', 'error');
                console.error('Error:', error);
            });
    });

    function showAlert(message, type) {
        const alert = document.getElementById('alert');
        alert.textContent = message;
        alert.className = `alert ${type}`;
        alert.style.display = 'block';

        // Auto hide success messages
        if (type === 'success') {
            setTimeout(() => {
                hideAlert();
            }, 5000);
        }
    }

    function hideAlert() {
        const alert = document.getElementById('alert');
        alert.style.display = 'none';
    }

    // Clear alerts when typing
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', hideAlert);
    });
    </script>
</body>

</html>
<?php
}
?>