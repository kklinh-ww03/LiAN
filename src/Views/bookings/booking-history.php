<?php ob_start(); ?>
<title>Booking History</title>
<div class="container mt-5" >
    <h1 class="text-center text-uppercase text-primary mb-5">Lịch sử Đặt Sân Của Bạn</h1>

    <!-- Hiển thị thông báo flash nếu có -->
    <?php
        if (isset($_SESSION['flash_message'])) {
            echo '<div id="flash-message" class="alert alert-info text-center">' . $_SESSION['flash_message'] . '</div>';
            unset($_SESSION['flash_message']);
        }
    ?>

    <?php if (!empty($bookings)): ?>
        <div class="table-responsive">
            <table class="table table-striped table-hover shadow-lg border rounded-lg mx-auto">
                <thead class="table-dark">
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Sân</th>
                        <th>Giá Mỗi Giờ</th>
                        <th>Ngày Check-in</th>
                        <th>Ngày Check-out</th>
                        <th>Ngày Đặt</th>
                        <th>Trạng Thái</th>
                        <th>Hành Động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td>
                                <img src="/image/<?= htmlspecialchars($booking['Yard_image']) ?>" class="img-fluid rectangle-img" alt="Yard Image">
                            </td>

                            <td><?= htmlspecialchars($booking['Yard_name']) ?></td>
                            <td><?= htmlspecialchars($booking['price_per_hour']) ?> VND</td>
                            <td><?= htmlspecialchars($booking['check_in']) ?></td>
                            <td><?= htmlspecialchars($booking['check_out']) ?></td>
                            <td><?= htmlspecialchars($booking['date_booking']) ?></td>
                            <td class="text-capitalize"><?= htmlspecialchars($booking['status']) ?></td>
                            <td>
                                <!-- Button to Cancel the Booking -->
                                <a href="/booking/cancel/<?= $booking['booking_id'] ?>" class="btn btn-danger btn-lg">Hủy</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">
            Bạn chưa có lịch sử đặt sân.
        </div>
    <?php endif; ?>

    <div class="text-center mt-4">
        <a href="/user/home" class="btn btn-primary btn-lg px-5 py-3 shadow-lg">Quay lại Trang Chủ</a>
    </div>
</div>

<!-- Custom CSS -->
<style>
    /* Căn giữa bảng và đặt margin top */
    .table-responsive {
        margin-top: 30px;
        max-width: 90%; /* Đảm bảo bảng không chiếm hết không gian */
    }

    table th, table td {
        vertical-align: middle;
        text-align: center;
        font-family: 'Arial', sans-serif;
    }

    .table th, .table td {
        padding: 1.5rem;
        border: none;
    }

    /* Căn giữa bảng trong trang */
    .table-responsive {
        max-width: 100%;
        margin: 0 auto;
    }

    /* Điều chỉnh font-size và padding của các nút */
    .btn-sm {
        font-size: 0.875rem;
        padding: 0.25rem 0.5rem;
    }

    .btn-lg {
        font-size: 1.125rem;
        padding: 0.75rem 1.5rem;
    }

    /* Thêm hiệu ứng hover cho hàng trong bảng */
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.1); /* Màu nền xanh nhạt khi hover */
        transform: scale(1.02); /* Phóng to khi hover */
        box-shadow: 0 4px 15px rgba(34, 152, 34, 0.6); /* Thêm bóng đổ cho hàng */
        transition: all 0.3s ease-in-out; /* Hiệu ứng chuyển động mượt mà */
    }

    /* Thêm hiệu ứng cho hình ảnh khi hover */
    .table-hover tbody tr:hover img {
        transform: scale(1.1); /* Phóng to hình ảnh */
        transition: all 0.3s ease-in-out; /* Hiệu ứng chuyển động mượt mà */
    }

    .btn-danger, .btn-warning, .btn-primary {
        font-size: 1rem;
        letter-spacing: 0.5px;
        transition: background-color 0.3s ease, transform 0.3s ease;
        padding: 0.5rem 1.2rem;
        border-radius: 50px; /* Bo góc nút */
    }

    .btn-danger:hover {
        background-color: rgb(23, 128, 51);
        transform: scale(1.05);
    }

    .btn-warning:hover {
        background-color: #ffc107;
        transform: scale(1.05);
    }

    .btn-primary:hover {
        background-color: rgba(235, 16, 16, 0.8);
        transform: scale(1.05);
    }

    /* Hiệu ứng bóng đổ cho bảng */
    .table-hover tbody tr {
        transition: background-color 0.3s ease, box-shadow 0.3s ease;
    }

    /* Thay đổi màu nền cho các hàng chẵn */
    .table-striped tbody tr:nth-of-type(odd) {
        background-color: #f2f2f2; /* Màu nền nhẹ cho hàng chẵn */
    }

    .shadow-lg {
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1) !important;
    }

    /* Hiển thị hình ảnh theo kiểu hình chữ nhật */
    .rectangle-img {
        width: 120px; /* Điều chỉnh chiều rộng hình ảnh */
        height: 80px; /* Điều chỉnh chiều cao hình ảnh */
        object-fit: cover; /* Đảm bảo hình ảnh không bị méo và lấp đầy khung */
        border-radius: 8px; /* Bo góc nhẹ cho hình ảnh */
    }
</style>

<?php $content = ob_get_clean(); ?>
<?php include(__DIR__ . '/../../../templates/layout.php'); ?>
