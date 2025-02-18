<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
ob_start();

if (isset($_SESSION['flash_message'])) {
    $message = $_SESSION['flash_message'];
    unset($_SESSION['flash_message']);
    echo '<div id="flash-message" class="alert alert-danger text-center shadow-lg rounded-pill">' . htmlspecialchars($message) . '</div>';
}

if (isset($_SESSION['errors'])) {
    $errors = $_SESSION['errors'];
    unset($_SESSION['errors']);
}
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footballyard Login/Signup</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Font Awesome CDN -->
    <style>
        * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: url('https://suachualaptop24h.com/upload_images/images/2024/08/06/hinh-nen-san-bong-dep-banner.jpg') no-repeat center center/cover;
    color: #333;
}

.container {
    position: relative;
    width: 1000px;
    height: 600px;
    background: rgba(255, 255, 255, 0.9);
    border-radius: 20px;
    box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
    display: flex;
    overflow: hidden;
}

.form-container {
    width: 50%;
    height: 100%;
    position: absolute;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    transition: all 0.5s ease-in-out;
}

.login-form {
    left: 0;
    z-index: 2;
}

.signup-form {
    right: 0;
    transform: translateX(100%);
    opacity: 0;
    z-index: 1;
}

.toggle-button {
    position: absolute;
    top: 0;
    width: 50%;
    height: 100%;
    color:rgb(255, 1, 5);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    text-align: center;
    transition: transform 0.5s ease;
    z-index: 5;
}
.toggle-button::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('https://haycafe.vn/wp-content/uploads/2022/01/Hinh-anh-bong-da.jpg') no-repeat center center/cover;
    filter: blur(3px); /* Làm mờ hình ảnh */
    z-index: 1; /* Đặt hình ảnh dưới văn bản */
}
.toggle-login {
    left: 50%;
    border-radius: 0 20px 20px 0;
}

.toggle-signup {
    left: 0;
    border-radius: 20px 0 0 20px;
    transform: translateX(-100%);
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
    width: 80%;
}
.toggle-button h3 {
    font-size: 24px; /* Tăng kích thước chữ */
    font-weight: 700; /* Làm chữ đậm */
    text-transform: uppercase; /* Chữ in hoa nếu muốn */
    letter-spacing: 1px; /* Khoảng cách giữa các chữ */
    color:rgb(239, 6, 10); /* Màu chữ */
    position: relative;
    z-index: 10; /* Đảm bảo chữ ở trên */
}
h2 {
    color: #2c3e50;
    font-size: 26px;
    margin-bottom: 10px;
}

.input-container {
    position: relative;
    width: 100%;
}

.input-container input {
    padding: 12px 12px 12px 40px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
}

.input-container i {
    position: absolute;
    left: 12px;
    top: 50%;
    transform: translateY(-50%);
    color: #aaa;
}

button {
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    background-color: #56ab2f;
    color: #fff;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #3b8c1a;
}

.container.active .login-form {
    transform: translateX(-100%);
    opacity: 0;
    z-index: 1;
}

.container.active .signup-form {
    transform: translateX(0);
    opacity: 1;
    z-index: 2;
}

.container.active .toggle-login {
    transform: translateX(100%);
}

.container.active .toggle-signup {
    transform: translateX(0);
}

.alert {
    position: absolute;
    top: 10px;
    left: 50%;
    transform: translateX(-50%);
    background-color: #ffefcc;
    color: #333;
    padding: 10px 20px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    font-size: 14px;
}

.error-message {
    color: #ff4d4f;
    font-size: 13px;
    margin-top: 5px;
    padding-left: 5px;
}

/* Giữ form đăng ký luôn hiển thị khi có lỗi */
.container.active .signup-form {
    transform: translateX(0);
    opacity: 1;
    z-index: 2;
}

/* Đảm bảo form đăng nhập không bị ẩn dưới */
.container.active .login-form {
    transform: translateX(-100%);
    opacity: 0;
    z-index: 1;
}

    </style>
</head>
<body>
    <div class="container" id="container">
        <!-- Form Đăng Nhập -->
        <div class="form-container login-form" id="loginForm">
            <form action="/auth/validate" method="post">
                <h2>Đăng nhập</h2>
                <div class="input-container">
                    <input type="text" id="username" name="username" placeholder="Username" required>
                    <i class="fas fa-user"></i>
                    <?php if (isset($errors['username'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($errors['username']); ?></div>
                    <?php endif; ?>
                </div>
                <div class="input-container">
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="fas fa-lock"></i>
                    <?php if (isset($errors['password'])): ?>
                        <div class="error-message"><?php echo htmlspecialchars($errors['password']); ?></div>
                    <?php endif; ?>
                </div>
                <button type="submit"><i class="fas fa-sign-in-alt"></i> Đăng nhập</button>
            </form>
        </div>

        <!-- Form Đăng Ký -->
        <div class="form-container signup-form" id="signupForm">
            <form action="/user/logup" method="post">
                <h2>Đăng ký</h2>
                <div class="input-container">
                    <input type="text" id="username" name="username" placeholder="Username" 
                        value="<?php echo htmlspecialchars($_SESSION['old_data']['username'] ?? ''); ?>" required>
                    <i class="fas fa-user"></i>
                
                </div>
                <div class="input-container">
                    <input type="text" id="fullname" name="fullname" placeholder="Full Name" 
                        value="<?php echo htmlspecialchars($_SESSION['old_data']['fullname'] ?? ''); ?>" required>
                    <i class="fas fa-user-tag"></i>
                    
                </div>
                <div class="input-container">
                    <input type="email" id="email" name="email" placeholder="Email" 
                        value="<?php echo htmlspecialchars($_SESSION['old_data']['email'] ?? ''); ?>" required>
                    <i class="fas fa-envelope"></i>
                    
                </div>
                <div class="input-container">
                    <input type="text" id="phone" name="phone" placeholder="Phone" 
                        value="<?php echo htmlspecialchars($_SESSION['old_data']['phone'] ?? ''); ?>" required>
                    <i class="fas fa-phone"></i>

                </div>
                <div class="input-container">
                    <input type="password" id="password_input" name="password_input" placeholder="Password" required>
                    <i class="fas fa-lock"></i>

                </div>
                <div class="input-container">
                    <input type="password" id="password_check" name="password_check" placeholder="Confirm Password" required>
                    <i class="fas fa-lock"></i>
        
                </div>
                <button type="submit"><i class="fas fa-user-plus"></i> Đăng ký</button>
            </form>
        </div>

        <!-- Nút chuyển đổi giữa đăng nhập và đăng ký -->
        <div class="toggle-button toggle-login" onclick="toggleForm()">
            <h3>Đăng ký</h3>
        </div>

        <div class="toggle-button toggle-signup" onclick="toggleForm()">
            <h3>Đăng nhập</h3>
        </div>
    </div>

    <script>
        const container = document.getElementById('container');

        function toggleForm() {
            container.classList.toggle('active');
            if (container.classList.contains('active')) {
                // Nếu form đăng ký bị lỗi, giữ lại form đăng ký
                document.getElementById('signupForm').style.opacity = 1;
                document.getElementById('signupForm').style.transform = 'translateX(0)';
            }
        }

        <?php if (isset($message)): ?>
            alert("<?php echo $message; ?>");
        <?php endif; ?>
    </script>
</body>
</html>