<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Yard - <?= htmlspecialchars($Yard['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .Yard-images img {
            max-height: 200px;
            object-fit: cover;
            border-radius: 5px;
            margin-bottom: 10px;
        }
        .main-image {
            height: 400px;
            object-fit: cover;
            width: 100%;
            border-radius: 10px;
        }
        .booking-section {
            display: flex;
            justify-content: center;
            align-items: center;
            border-radius: 8px;
        }
        .booking-section button {
            display: block;
            width: auto;
        }
    </style>
</head>
<body>
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <img src="/image/<?= htmlspecialchars($Yard['image']) ?>" class="main-image" alt="Hình ảnh chính của sân">
        </div>
        <div class="col-md-12 Yard-images mt-3">
            <div class="row">
                <div class="col-md-3">
                    <img src="/image/<?= htmlspecialchars($Yard['image']) ?>" class="img-fluid" alt="Hình">
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-8">
            <h2 class="text-primary"><?= htmlspecialchars($Yard['name']) ?></h2>
            <p><strong>Mô tả:</strong> <?= nl2br(htmlspecialchars($Yard['description'])) ?></p>
            <p><strong>Giá mỗi giờ:</strong> <span class="text-danger fs-5"><?= number_format($Yard['price_per_hour']) ?> VND</span></p>
            <p><strong>Trạng thái:</strong> 
                <?= $Yard['status'] === 'trống' ? '<span class="text-success">Còn trống</span>' : '<span class="text-danger">Đang bận</span>' ?>
            </p>
        </div>

        <div class="col-md-4">
            <div class="booking-section mt-3">
                <?php if ($Yard['status'] === 'trống'): ?>
                    <form action="/booking/TaoBooking/<?= isset($Yard['id']) ? $Yard['id'] : '' ?>" method="POST">
                        <input type="hidden" name="user_id" value="<?= $_SESSION['currentUser']['id'] ?>">
                        <input type="hidden" name="Yard_id" value="<?= $Yard['id'] ?>">
                        <button type="submit" class="btn btn-success">Đặt Sân</button>
                    </form>
                <?php else: ?>
                    <div class="alert alert-warning">Sân hiện không có sẵn.</div>
                <?php endif; ?>
            </div>
            <div class="col-md-12 text-center mt-3">
                <a href="/user/home/intro" class="btn btn-primary">Quay lại danh sách sân</a>
            </div>
        </div>
    </div>
</div>
</body>
</html>