<?php
namespace App\Controllers;

use App\Models\User;

class AuthenticationController {

    public function __construct() {}

    public function authenticate() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $errors = [];

            $user = (new User())->getUserByUsername($username);

            if (!$user) {
                // Nếu không tìm thấy tài khoản, hiển thị thông báo tài khoản không tồn tại
                $errors['username'] = "Tài khoản không tồn tại!";
            }

            if ($password !== $user['password']) {
                // Nếu mật khẩu không khớp, hiển thị lỗi
                $errors['password'] = "Mật khẩu sai!";
            }

            // Nếu có lỗi, lưu lỗi vào session và chuyển hướng lại trang đăng nhập
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: ../user/signin");
                exit();
            }

            // Nếu không có lỗi, đăng nhập thành công
            session_start();
            $_SESSION['currentUser'] = $user;
            $_SESSION['flash_message'] = "Đăng nhập thành công";

            // Redirect based on user role
            if ($user['role'] === 'customer') {
                header("Location: /user/home");
            }
            exit();
        }
    }
}