<?php ob_start(); ?> 
<title>Home Page</title>
<style>
.home-banner {
    position: relative;
    width: 100%;
    height: 100vh;
    overflow: hidden;
}

.banner-slides {
    display: flex;
    width: 400%; /* Điều chỉnh chiều rộng để chứa tất cả các slide */
    transition: transform 1s ease-in-out;
}

.slide {
    width: 100vw;
    height: 100vh;
    background-size: cover;
    background-position: center;
}

.banner-content {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    z-index: 10;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
}

.text-center {
    text-align: center;
}

/* Giao diện phần dưới */
.features-section {
    display: flex;
    padding: 50px 10%;
    background: #fff3e0;
    color: #333;
    justify-content: flex-start; /* Căn chỉnh phần tử ở bên trái */
    align-items: center;
    gap: 30px;
}

.feature-image {
    flex: 0 0 50%; /* Điều chỉnh ảnh chiếm 50% chiều rộng */
    display: flex;
    flex-direction: row; /* Chỉnh chiều ảnh theo hàng ngang */
    gap: 20px; /* Khoảng cách giữa các ảnh */
}

.feature-image img {
    width: 48%; /* Đảm bảo mỗi ảnh chiếm 48% chiều rộng */
    height: auto;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
}

.feature-text {
    flex: 1;
}

.feature-text h2 {
    font-size: 2rem;
    color: #ff6f00;
    margin-bottom: 20px;
}

.feature-text p {
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 20px;
}

.feature-text ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.feature-text ul li {
    margin-bottom: 10px;
    font-size: 1rem;
    display: flex;
    align-items: center;
}

.feature-text ul li i {
    color: #ff6f00;
    margin-right: 10px;
}

.feature-text .btn {
    display: inline-block;
    padding: 10px 20px;
    color: #fff;
    background: #ff6f00;
    border-radius: 5px;
    text-decoration: none;
    font-size: 1rem;
    margin-top: 20px;
    transition: background 0.3s;
}

.feature-text .btn:hover {
    background: #e65100;
}
</style>

<?php
// Hiển thị thông báo Flash Message (nếu có)
if (isset($_SESSION['flash_message'])) {
    echo '<div id="flash-message" class="alert alert-success text-center">' . $_SESSION['flash_message'] . '</div>';
    unset($_SESSION['flash_message']);
}
?>

<div class="home-banner">
    <div class="banner-slides">
        <div class="slide" style="background-image: url('/image/L1.jpg');"></div>
    </div>
    <div class="banner-content text-center">
        <h1 class="display-3">LiAN'S FOOTBALL YARD COMPANY</h1>
        <p>Nơi cung cấp các sân bóng với chất lượng hàng đầu. Hãy tìm sân bóng lý tưởng để thỏa sức đam mê!</p>
    </div>
</div>

<!-- Giao diện phần dưới -->
<div class="features-section">
    <!-- Phần hình ảnh -->
    <div class="feature-image">
        <img src="/image/anh3.jpg" alt="Image 1">
        <img src="/image/anh4.jpg" alt="Image 2">
    </div>

    <!-- Phần nội dung -->
    <div class="feature-text">
        <h2>Đặt sân bóng dễ dàng</h2>
        <p>Khám phá các sân bóng chất lượng, dễ dàng đặt lịch và tận hưởng trải nghiệm chơi bóng tuyệt vời ngay tại website của chúng tôi.</p>
        <ul>
            <li><i class="fas fa-shield-alt"></i> Tìm sân bóng gần bạn: Xem thông tin chi tiết, vị trí và giá cả của các sân bóng trong khu vực.</li>
            <li><i class="fas fa-futbol"></i> Đặt sân nhanh chóng: Chọn thời gian, sân bóng và hoàn tất giao dịch chỉ trong vài phút.</li>
        </ul>
    </div>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>
