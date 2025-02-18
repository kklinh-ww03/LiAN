<?php ob_start(); ?>
<title>User Form</title>
<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-8 col-lg-6">
        <h1 class="text-center mb-4 text-highlight"><?= isset($user['id']) ? 'Cập Nhật Người Dùng' : 'Tạo Người Dùng' ?></h1>

        <!-- Flash Message -->
        <?php
        if (isset($_SESSION['flash_message'])) {
            echo '<div id="flash-message" class="alert alert-info text-center">' . $_SESSION['flash_message'] . '</div>';
            unset($_SESSION['flash_message']);
        }
        ?>

        <form action="/user/<?= isset($user['id']) ? "update/$user[id]" : 'create' ?>" method="POST" class="shadow-lg p-4 rounded-3 bg-white">

            <!-- Username Field -->
            <div class="mb-4 row">
                <label for="username" class="col-sm-4 col-form-label text-bold text-uppercase" style="color: #007bff;">
                    <i class="fas fa-user me-2"></i>Tài khoản:
                </label>
                <div class="col-sm-8">
                    <input type="text" id="username" name="username" class="form-control form-control-lg" 
                           value="<?= isset($user['username']) ? $user['username'] : '' ?>" required>
                </div>
            </div>

            <!-- Full Name Field -->
            <div class="mb-4 row">
                <label for="fullname" class="col-sm-4 col-form-label text-bold text-uppercase" style="color: #007bff;">
                    <i class="fas fa-user-circle me-2"></i>Họ và Tên:
                </label>
                <div class="col-sm-8">
                    <input type="text" id="fullname" name="fullname" class="form-control form-control-lg" 
                           value="<?= isset($user['fullname']) ? $user['fullname'] : '' ?>" required>
                </div>
            </div>

            <!-- Email Field -->
            <div class="mb-4 row">
                <label for="email" class="col-sm-4 col-form-label text-bold text-uppercase" style="color: #007bff;">
                    <i class="fas fa-envelope me-2"></i>Email:
                </label>
                <div class="col-sm-8">
                    <input type="email" id="email" name="email" class="form-control form-control-lg" 
                           value="<?= isset($user['email']) ? $user['email'] : '' ?>" required>
                </div>
            </div>

            <!-- Phone Field -->
            <div class="mb-4 row">
                <label for="phone" class="col-sm-4 col-form-label text-bold text-uppercase" style="color: #007bff;">
                    <i class="fas fa-phone me-2"></i>Số Điện Thoại:
                </label>
                <div class="col-sm-8">
                    <input type="text" id="phone" name="phone" class="form-control form-control-lg" 
                           value="<?= isset($user['phone']) ? $user['phone'] : '' ?>" required>
                </div>
            </div>

            <?php if (isset($_SESSION['currentUser']) && $_SESSION['currentUser']['role'] == 'admin'): ?>
                <!-- Role Field (Admin only) -->
                <div class="mb-4 row">
                    <label for="role" class="col-sm-4 col-form-label text-bold text-uppercase" style="color: #007bff;">
                        <i class="fas fa-shield-alt me-2"></i>Vai Trò:
                    </label>
                    <div class="col-sm-8">
                        <select id="role" name="role" class="form-select form-control-lg" required>
                            <option value="admin" <?= isset($user['role']) && $user['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                            <option value="customer" <?= isset($user['role']) && $user['role'] == 'customer' ? 'selected' : '' ?>>Khách Hàng</option>
                        </select>
                    </div>
                </div>
            <?php elseif (!isset($user['role'])): ?>
                <input type="hidden" name="role" value="customer">
            <?php endif; ?>

            <!-- Password Field -->
            <div class="mb-4 row">
                <label for="password_input" class="col-sm-4 col-form-label text-bold text-uppercase" style="color: #007bff;">
                    <i class="fas fa-key me-2"></i>Mật Khẩu:
                </label>
                <div class="col-sm-8">
                    <input type="password" id="password_input" name="password_input" class="form-control form-control-lg" 
                            value="<?= isset($user['password']) ? $user['password'] : '' ?>" required>
                </div>
            </div>
            
            <?php if (!isset($user['id'])): ?>
                <!-- Confirm Password Field -->
                <div class="mb-4 row">
                    <label for="password_check" class="col-sm-4 col-form-label text-bold text-uppercase" style="color: #007bff;">
                        <i class="fas fa-check-circle me-2"></i>Xác Nhận Mật Khẩu:
                    </label>
                    <div class="col-sm-8">
                        <input type="password" id="password_check" name="password_check" class="form-control form-control-lg" required>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Submit Button -->
            <div class="d-grid mb-4">
                <button type="submit" class="btn btn-gradient btn-lg text-white">
                    <?= isset($user['id']) ? 'Cập Nhật' : 'Tạo' ?>
                </button>
            </div>

            <!-- Back Link -->
            <div class="text-center">
            <?php if ($_SESSION['currentUser']['role'] == 'admin'): ?>
                <a href="/user/index" class="btn btn-link text-decoration-none text-primary">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách người dùng
                </a>
            <?php elseif ($_SESSION['currentUser']['role'] == 'customer'): ?>
                <a href="/user/profile" class="btn btn-link text-decoration-none text-primary">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại 
                </a>
            <?php endif; ?>
            </div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>
