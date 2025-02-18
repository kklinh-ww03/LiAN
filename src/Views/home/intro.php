<?php ob_start(); ?>
<title>InTro Yard</title>
<style>
    /* General Styles */
    body {
        font-family: 'Arial', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #f4f4f4;
        opacity: 1 !important; 
        filter: none !important; 
    }

    /* Navbar Styles */
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #2c3e50;
        padding: 20px;
        color: white;
        position: relative;
        z-index: 100;
    }

    .navbar a:hover {
        color: #1abc9c;
    }

    /* Banner Section */
    .banner {
        position: relative;
        width: 100%;
        height: 400px;
        background: url('/image/banner_home.jpg') no-repeat center center;
        background-size: cover;
        filter: none; /* Xóa bỏ bất kỳ filter gây mờ */
    }

    .banner-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        color: white;
    }

    .banner-text h1 {
        font-size: 3rem;
        margin: 0;
    }

    .banner-text p {
        font-size: 1.25rem;
    }

    /* Homestay Section */
    .homestay-list {
    padding: 40px 20px;
    background-color: white;
}

.homestay-list .container {
    display: flex;
    justify-content: center; /* Căn giữa tất cả các phần tử */
    flex-wrap: wrap;
    gap: 20px;
}

.homestay-item {
    width: 30%;
    background-color: #fff;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    margin-bottom: 20px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
    position: relative;
    filter: none !important;
    opacity: 1 !important;
    text-align: center;
}

.homestay-item img {
    width: 100%;
    height: 200px;
    object-fit: cover;
}

.homestay-item h3 {
    font-size: 1.5rem;
    padding: 15px;
    margin: 0;
    font-weight: 600;
    color: #333;
    text-align: center;
}

.homestay-item p {
    padding: 0 15px;
    font-size: 1rem;
    color: #7f8c8d;
    margin-bottom: 15px;
    text-align: center;
}

.homestay-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

@media (max-width: 480px) {
    .homestay-item {
        width: 100%;
    }
    .banner-text h1 {
        font-size: 2rem;
    }
}
</style>
<div class="container">
    <section class="homestay-list">
        <div class="container">
<?php foreach ($Yards as $Yard): ?>
                <div class="homestay-item">
                    <img src="/image/<?= htmlspecialchars($Yard['image']) ?>" alt="<?= htmlspecialchars($Yard['name']) ?>">
                    <h5><?= htmlspecialchars($Yard['name']) ?></h5>
                    <p><?= htmlspecialchars($Yard['description']) ?></p>
<p class="card-text"><strong>Giá sân:</strong> <?= number_format($Yard['price_per_hour'], 0, ',', '.') ?> VND</p>
                        <a href="/Yard/details/<?= $Yard['id'] ?>" class="btn btn-primary">Xem Chi Tiết</a>
                        <a href="/booking/TaoBooking/<?= $Yard['id'] ?>" class="btn btn-success">Đặt Sân</a>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>
