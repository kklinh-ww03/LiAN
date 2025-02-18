<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Yard;
use App\Controller;


class UserController extends Controller
{
    private $userModel;
    private $YardModel;
    public function __construct()
    {
        $this->userModel = new User();
        $this->YardModel = new Yard();
        $this->startSession();
    }

    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index()
    {
        $this->ensureLoggedIn();
        $this->render('users\index', []);
    }

    public function userHome()
    {
        $this->ensureLoggedIn();
        $Yards = $this->YardModel->getAllYards();
        $this->render('home/home-list', ['Yards' => $Yards]);
    }

    public function create()
    {
        $this->ensureLoggedIn();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processForm();
        } else {
            $this->render('users\user-form', ['user' => []]);
        }
    }
    
    private function processForm()
    {
        // Retrieve form data
        $username = $_POST['username'];
        $password = $_POST['password_input'];
        $passwordCheck = $_POST['password_check'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $role = $_POST['role'];
    
        // Validate password and password_check
        if ($password !== $passwordCheck) {
            echo 'Mật khẩu không khớp.';
            return;
        }
        // Call the model to create a new user
        $user = $this->userModel->createUser($username, $password, $fullname, $email, $phone, $role);
    
        if ($user) {
            header('Location: /user/index');
            exit();
        } else {
            echo 'User creation failed. Please try again.';
        }
    }


    public function update($userId)
    {
        $this->ensureLoggedIn();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->processFormUpdate($userId);
        } else {
            $user = $this->userModel->getUserById($userId);
            $this->render('users\user-form', ['user' => $user]);
        }
    }

    private function processFormUpdate($userId)
{
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password_input'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $role = $_POST['role'];

    // Get current logged-in user's role
    $currentUserRole = $_SESSION['currentUser']['role']; // assuming you store user role in session

    $role = 'customer';
    // If a new password is provided, update it
    if (!empty($password)) {
        $user = $this->userModel->updateUser($userId, $username, $password, $fullname, $email, $phone, $role);
    } else {
        // If no new password is given, update without changing the password
        $user = $this->userModel->updateUserWithoutPassword($userId, $username, $fullname, $email, $phone, $role);
    }

    if ($user) {
        if ($_SESSION['currentUser']['role'] === 'customer') {
            header('Location: /user/profile');
        } else {
            header('Location: /user/index');
        }
        exit();
    } else {
        echo 'User update failed.';
    }
}

    public function signin()
    {
        $this->render('users\signin', []);
    }

    public function logout()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();
            if (isset($_SESSION['currentUser'])) {
                unset($_SESSION['currentUser']);
                session_destroy();
                header("Location: ../index");
                exit();
            }
        }
    }

    public function ensureLoggedIn()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['currentUser'])) {
            header('Location: /user/signin');
            exit();
        }
    }

    public function registerUser()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $username = $_POST['username'];
            $password = $_POST['password_input'];
            $passwordCheck = $_POST['password_check'];
            $fullName = $_POST['fullname'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            
            // Kiểm tra nếu mật khẩu và xác nhận mật khẩu trùng khớp
            if ($password !== $passwordCheck) {
                $_SESSION['flash_message'] = 'Mật khẩu không khớp.';
                header('Location: /user/signup');
                exit();
            }
    
            // Kiểm tra trùng tên người dùng

            if ($this->userModel->isUsernameExists($username)) {
                $_SESSION['flash_message'] = 'Tài khoản đã tồn tại!';
                header('Location: /user/signup');
                exit();
            }
    
            // Kiểm tra trùng email
            if ($this->userModel->isEmailExists($email)) {
                $_SESSION['flash_message'] = 'Email đã được sử dụng!';
                header('Location: /user/signup');
                exit();
            }
    
            // Kiểm tra số điện thoại hợp lệ
            if (!preg_match('/^[0-9]{10,15}$/', $phone)) {
                $_SESSION['flash_message'] = 'Số điện thoại không hợp lệ!';
                header('Location: /user/signup');
                exit();
            }
            
            // Tạo đối tượng User và gọi hàm tạo người dùng
            $role = 'customer'; // Mặc định gán role là customer
            $user = $this->userModel->createUser($username, $password, $fullName, $email, $phone, $role);
    
            session_start();
            if ($user) {
                $_SESSION['flash_message'] = 'Đăng ký thành công. Hãy đăng nhập.';
                header('Location: /user/signup');
            } else {
                // Lưu thông báo lỗi vào session và chuyển hướng
                $_SESSION['flash_message'] = 'Đăng ký thất bại. Hãy thử lại.';
                header('Location: /user/signup');
            }
            exit();
        }
    }
    
    public function profile()
    {
        $this->ensureLoggedIn();
        
        // Lấy thông tin người dùng từ session
        $userId = $_SESSION['currentUser']['id']; // Giả sử bạn lưu id người dùng trong session
        $user = $this->userModel->getUserById($userId);
        
        // Nếu không tìm thấy người dùng, chuyển hướng về trang đăng nhập
        if (!$user) {
            $_SESSION['flash_message'] = 'Không tìm thấy user.';
            header('Location: /user/signin');
            exit();
        }
        
        // Render trang profile và truyền dữ liệu người dùng vào view
        $this->render('users\profile', ['user' => $user]);
    }


}
