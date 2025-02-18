<?php ob_start(); ?>
<title>User Profile</title>
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Thông tin cá nhân</h1>

    <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Flash message display
    if (isset($_SESSION['flash_message'])) {
        $message = $_SESSION['flash_message'];
        unset($_SESSION['flash_message']);
        echo '<div id="flash-message" class="alert alert-danger text-center shadow-lg rounded-pill">' . htmlspecialchars($message) . '</div>';
    }

    // Handle undefined or null keys in $user array
    $user = isset($user) ? $user : [];
    $fullName = isset($user['fullname']) && $user['fullname'] ? htmlspecialchars($user['fullname']) : 'N/A';
    $email = isset($user['email']) && $user['email'] ? htmlspecialchars($user['email']) : 'N/A';
    $role = isset($user['role']) && $user['role'] ? htmlspecialchars($user['role']) : 'N/A';
    $username = isset($user['username']) && $user['username'] ? htmlspecialchars($user['username']) : 'N/A';
    $phone = isset($user['phone']) && $user['phone'] ? htmlspecialchars($user['phone']) : 'N/A';
    $createdAt = isset($user['created_at']) && $user['created_at'] ? date('F j, Y', strtotime($user['created_at'])) : 'N/A';
    ?>

    <!-- Profile Information -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- User Information -->
            <div class="card shadow-lg border-0 rounded-3">
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-light">
                            <strong>Tài khoản:</strong> <?= $username ?>
                        </li>
                        <li class="list-group-item bg-light">
                            <strong>Họ và tên:</strong> <?= $fullName ?>
                        </li>
                        <li class="list-group-item bg-light">
                            <strong>Email:</strong> <?= $email ?>
                        </li>                        
                        <li class="list-group-item bg-light">
                            <strong>Số điện thoại:</strong> <?= $phone ?>
                        </li>
                        <li class="list-group-item bg-light">
                            <strong>Vai trò:</strong> <?= $role ?>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Edit Profile Button -->
            <div class="mt-5 text-center">
                <a href="/user/update/<?= isset($user['id']) ? $user['id'] : '#' ?>" class="btn btn-primary btn-lg rounded-pill shadow-lg">Chỉnh sửa thông tin cá nhân</a>
            </div>
        </div>
    </div>

    <!-- Back Button -->
    <div class="text-center mt-4">
        <?php
            echo '<a href="/user/home" class="btn btn-link text-decoration-none text-primary"><i class="fas fa-arrow-left me-2"></i>Trở lại trang chủ</a>';
        ?>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>
