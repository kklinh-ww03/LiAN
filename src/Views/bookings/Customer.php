<?php ob_start(); ?>
<title>Booking Yard</title>
<div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-8 col-lg-6">
        <h1 class="text-center mb-4 text-highlight">Tạo Đặt Sân</h1>

        <!-- Flash Message -->
        <?php
        if (isset($_SESSION['flash_message'])) {
            echo '<div id="flash-message" class="alert alert-info text-center">' . $_SESSION['flash_message'] . '</div>';
            unset($_SESSION['flash_message']);
        }
        ?>

        <form action="/booking/TaoBooking/<?= isset($Yard['id']) ? $Yard['id'] : '' ?>" method="POST" class="shadow-lg p-4 rounded-3 bg-white">

            <!-- User -->
            <div class="mb-4 row">
                <label for="user_id" class="col-sm-4 col-form-label text-bold text-uppercase" style="color: #007bff;">
                    <i class="fas fa-user me-2"></i>Người dùng:
                </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-lg" value="<?= htmlspecialchars($_SESSION['currentUser']['username']) ?>" disabled>
                    <input type="hidden" name="user_id" value="<?= $_SESSION['currentUser']['id'] ?>">
                </div>
            </div>

            <!-- Yard -->
            <div class="mb-4 row">
                <label for="Yard_id" class="col-sm-4 col-form-label text-bold text-uppercase" style="color: #007bff;">
                    <i class="fas fa-door-open me-2"></i>Sân:
                </label>
                <div class="col-sm-8">
                    <input type="text" class="form-control form-control-lg" value="<?= htmlspecialchars($Yard['name']) ?>" disabled>
                    <input type="hidden" name="Yard_id" value="<?= $Yard['id'] ?>">
                </div>
            </div>

            <!-- Check-in Date -->
            <div class="mb-4 row">
                <label for="check_in" class="col-sm-4 col-form-label text-bold text-uppercase" style="color: #007bff;">
                    <i class="fas fa-calendar-check me-2"></i>Ngày nhận sân:
                </label>
                <div class="col-sm-8">
                    <input type="date" id="check_in" name="check_in" class="form-control form-control-lg" min="<?= date('Y-m-d') ?>" required>
                </div>
            </div>

            <!-- Check-out Date -->
            <div class="mb-4 row">
                <label for="check_out" class="col-sm-4 col-form-label text-bold text-uppercase" style="color: #007bff;">
                    <i class="fas fa-calendar-times me-2"></i>Ngày trả sân:
                </label>
                <div class="col-sm-8">
                    <input type="date" id="check_out" name="check_out" class="form-control form-control-lg" min="<?= date('Y-m-d') ?>"required>
                </div>
            </div>

            <!-- Submit Button -->
<div class="d-grid mb-4">
                <button type="submit" class="btn btn-gradient btn-lg text-white">
                    <i class="fas fa-check-circle me-2"></i>Tạo Đặt sân
                </button>
            </div>

            <!-- Back Link -->
            <div class="text-center">
                <a href="/user/home/intro" class="btn btn-link text-decoration-none text-primary">
                    <i class="fas fa-arrow-left me-2"></i>Quay lại danh sách sân
                </a>
            </div>
        </form>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>