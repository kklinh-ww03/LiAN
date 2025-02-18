<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">




    <style>
    @media (min-width: 1400px) {
        .container, .container-lg, .container-md, .container-sm, .container-xl, .container-xxl {
            max-width: 100%;
        }
    }
    .form-control:focus, .btn-gradient:hover {
        box-shadow: 0 0 8px rgba(255, 0, 127, 0.6);
        transform: scale(1.05);
    }

    .btn-gradient {
        background: linear-gradient(to right, #f97316, #ff3b30, #ff007f);
    }
    
    .form-control {
    width: 100%;
    box-sizing: border-box;
    }

    .mb-3 {
        width: 100%; /* Đảm bảo phần tử cha có chiều rộng 100% */
    }
    
    body {
        background-color: #f4f6f9;
        font-family: Arial, sans-serif;
        max-width: 100%;
    }
    .navbar {
        background-color: #5a9e6f;
        color: white;
        position: sticky;
        top: 0;
        z-index: 1020;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Added subtle shadow */
    }
    .navbar .navbar-brand {
        color: white;
        font-weight: bold;
        font-size: 1.5rem;
    }
    .navbar-nav .nav-link {
        font-size: 1.1rem; /* Slightly larger text */
        padding: 12px 20px;
    }
    .navbar-nav .nav-link:hover {
        background-color: rgba(173, 216, 230, 0.3);
        border-radius: 8px;
        transform: scale(1.05);
        transition: transform 0.3s ease, background-color 0.3s ease;
    }

    .sidebar {
        position: sticky;
        top: 0;
        background-color: #5a9e6f;
        color: white;
        height: 100vh;
        padding-top: 20px;
        width: 250px;
        overflow-y: auto;
        border-radius: 10px 0 0 10px; /* Rounded corners */
    }
    .sidebar a {
        color: white;
        text-decoration: none;
        display: block;
        padding: 12px 20px;
        font-size: 1.2rem;
        transition: background-color 0.3s ease;
    }
    .sidebar a:hover {
        background-color: #77c699;
        border-radius: 8px;
    }

    /* Flash message */
    #flash-message {
        opacity: 1;
        transition: opacity 1s ease-out;
        z-index: 9999;
        display: block;
    }

    #flash-message.fade-out {
        opacity: 0;
        transition: opacity 1s ease-out, display 0s 1s;
    }

    /* Highlight effect */
    .highlight {
        background-color: rgba(144, 238, 144, 0.4);
        box-shadow: 0 0 10px rgba(144, 238, 144, 0.6);
        border-radius: 8px;
transform: scale(1.02);
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
    }

    .active-link {
        background-color: rgba(144, 238, 144, 0.6);
        color: #004d99;
        box-shadow: 0 0 10px rgba(144, 238, 144, 0.8);
        transform: scale(1.05);
        border-radius: 6px;
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
    }

    /* Floating labels for form fields */
    .form-control:focus {
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.6);
        border-color: #007bff;
    }
    .form-label {
        font-weight: bold;
        color: #5a9e6f; /* Elegant label color */
    }

    .btn-update {
        background: linear-gradient(to right, #f97316, #ff3b30, #ff007f);
        font-size: 1.25rem;
        font-weight: bold;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-update:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
    }

    .btn-update:focus {
        outline: none;
        box-shadow: 0 0 10px 4px rgba(255, 0, 127, 0.6);
    }

    form .form-control {
        max-width: 500px;
        margin-bottom: 20px;
    }

    form button {
        height: 50px;
    }

    /* Add a smooth hover effect for buttons */
    .btn {
        transition: background-color 0.3s ease, transform 0.3s ease;border-radius: 50px;
    }

    .btn:hover {
        background-color: rgb(23, 128, 51);
        transform: scale(1.05);
    }

    footer {
        background-color: #2c3e50;
        color: white;
        text-align: center;
        padding: 20px;
        position: relative;
        margin-top: 40px;
    }

    .contact-section h2 {
        font-size: 1.5rem;
        margin-bottom: 20px;
    }

    .contact-info {
        display: flex;
        justify-content: center;
        gap: 40px;
        flex-wrap: wrap;
        margin-top: 20px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        font-size: 16px;
        color: #aaa;
    }

    .contact-item p {
        margin: 0px;
    }

    .contact-item i {
        font-size: 20px;
        margin-right: 10px;
        color:rgb(23, 128, 51);
    }

    .contact-item a {
        color:rgb(23, 128, 51);
        text-decoration: none;
    }

    .contact-item a:hover {
        text-decoration: underline;
    }

    .social-links {
        margin-top: 30px;
    }

    .social-icon {
        font-size: 30px;
        margin: 0 15px;
        color: #fff;
        transition: color 0.3s ease;
    }

    .social-icon:hover {
        color:rgb(23, 128, 51);
    }

    .footer-bottom p {
        margin-top: 30px;
        font-size: 14px;
        color: #bbb;
    }

    /* Tùy chỉnh card */
    .card {
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    /* Tùy chỉnh nút */
    .btn-warning {
        background-color: #f39c12;
        border-color: #f39c12;
    }
.btn-warning:hover {
        background-color: #e67e22;
        border-color: #e67e22;
    }

    .btn-primary {
        background-color:rgb(40, 183, 99);
        border-color: rgb(40, 183, 99);
    }

    .btn-primary:hover {
        background-color: rgb(40, 183, 99);
        border-color: rgb(40, 183, 99);
    }

    #avatar-btn {
    color: rgb(40, 183, 99);
    }

    #avatar-btn:hover {
        color: rgb(231, 25, 25);
        transform: scale(1.1); /* Phóng to icon một chút */
    }
    
</style>



</head>
<body>
    <?php if (isset($_SESSION['currentUser'])): ?>
        <?php if ($_SESSION['currentUser']['role'] === 'customer'): ?>
            <!-- Customer Interface -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <!-- Logo section -->
                    <a class="navbar-brand">
                        <img src="/image/logo.jpg" alt="Logo" style="height: 40px;">
                    </a>

                    <!-- Navbar links -->
                    <div class="collapse navbar-collapse">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="/user/home">Trang chủ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/user/home/intro" id="booking-link">Đặt sân</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/booking/history/<?= htmlspecialchars($_SESSION['currentUser']['id']) ?>">Lịch sử đặt sân</a>
                            </li>
                            
                        </ul>

                        <!-- User Authentication Links -->
                        <ul class="navbar-nav ms-auto d-flex align-items-center">
                            <li class="nav-item d-flex align-items-center">
                                <!-- Icon Avatar -->
                                <i class="bi bi-person-circle" 
                                style="font-size: 40px; cursor: pointer;" 
                                id="avatar-btn"></i>
                                <!-- Username -->
                                <span class="navbar-text ms-2">
                                    Xin chào, <?= htmlspecialchars($_SESSION['currentUser']['username']) ?>
                                </span>
                            </li>
                            <li class="nav-item">
                                <form action="/user/logout" method="post" class="d-inline">
                                    <button type="submit" class="btn btn-danger ms-3">Đăng xuất</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="container mt-4">
                <!-- Flash Message -->
                <?php if (isset($_SESSION['flash_message'])): ?>
                    <div id="flash-message" class="alert alert-danger text-center">
                        <?= $_SESSION['flash_message']; ?>
                    </div>
                    <?php unset($_SESSION['flash_message']); ?>
                <?php endif; ?>
                <?= $content ?>
            </div>
            <footer>
    <div class="contact-section">
        <h2>Thông Tin Liên Hệ</h2>
        <div class="contact-info">
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <p>Địa chỉ: 03 Lê Quý Đôn, Thành phố Huế, Việt Nam</p>
            </div>
            <div class="contact-item">
                <i class="fas fa-phone-alt"></i>
                <p>Số điện thoại: <a href="tel:09876543210">098-7654-3210</a></p>
            </div>
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <p>Email: <a href="mailto:contact@secondhouse.com">lian@footballyard.com</a></p>
            </div>
        </div>
    </div>

    <div class="social-links">
        <a href="https://facebook.com" target="_blank" class="social-icon"><i class="fab fa-facebook"></i></a>
        <a href="https://twitter.com" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
        <a href="https://instagram.com" target="_blank" class="social-icon"><i class="fab fa-instagram"></i></a>
    </div>

</footer>

        <?php endif; ?>
    <?php else: ?>
        <div class="container mt-4">
                <?= $content ?>
        </div>
    <?php endif; ?>

    <!-- JavaScript for Flash Message and Highlighting -->
    <script>
   window.addEventListener('load', function () {
    var flashMessage = document.getElementById('flash-message');

    if (flashMessage) {
        // Wait 3 seconds before starting fade-out
        setTimeout(function () {
            flashMessage.classList.add('fade-out');
        }, 3000);

        flashMessage.addEventListener('transitionend', function () {
            if (flashMessage.classList.contains('fade-out')) {
                flashMessage.style.display = 'none';
            }
        });
    }

    // Function to remove highlight and active-link classes
    function removeHighlightAndActiveLink() {
        // Remove active-link from all navbar links
        var navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(function (link) {
            link.classList.remove('active-link');
        });

        // Remove highlight class from all sections
        var highlightSections = document.querySelectorAll('.highlight');
        highlightSections.forEach(function (section) {
            section.classList.remove('highlight');
        });
    }

    // Highlight the appropriate link and section based on the URL
    function highlightSection(linkSelector, sectionId) {
        var link = document.querySelector(linkSelector);
        if (link) {
            removeHighlightAndActiveLink();
            link.classList.add('active-link'); // Highlight the link
        }

        var section = document.getElementById(sectionId);
        if (section) {
            section.classList.add('highlight'); // Highlight the section
        }
    }

    // Highlight logic for specific sections
    if (window.location.href.includes('/home/intro')) {
        highlightSection('a.nav-link[href="/home/intro"]', 'intro-section');
    } else if (window.location.href.includes('/booking/history/<?= htmlspecialchars($_SESSION['currentUser']['id']) ?>')) {
        highlightSection('a.nav-link[href="/booking/history/<?= htmlspecialchars($_SESSION['currentUser']['id']) ?>"]', 'history-section');
    } else if (window.location.href.includes('/user/home') || window.location.href.includes('/home')) {
        highlightSection('a.nav-link[href="/user/home"]', 'home-section');
    }

    // Add event listeners for each navbar link to dynamically add/remove highlights
    var navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(function (link) {
        link.addEventListener('click', function () {
            removeHighlightAndActiveLink();
            link.classList.add('active-link'); // Add active-link to the clicked link

            // Optionally highlight the related section
            var targetSectionId = link.getAttribute('href').substring(1); // Get section ID from href
            var targetSection = document.getElementById(targetSectionId);
            if (targetSection) {
                targetSection.classList.add('highlight'); // Apply highlight to the section
            }
        });
    });

    // Redirect to profile when clicking avatar
    var avatarBtn = document.getElementById("avatar-btn");
    if (avatarBtn) {
        avatarBtn.addEventListener("click", function () {
            window.location.href = "/user/profile";
        });
    }
    });
    </script>
</body>
</html>