<?php

namespace App\Controllers;

use App\Models\booking;
use App\Models\Yard;
use App\Models\User;
use App\Controller;

class BookingController extends Controller
{
    private $bookingModel;
    private $YardModel;
    private $userModel;

    public function __construct()
    {
        $this->bookingModel = new booking();
        $this->YardModel = new Yard();
        $this->userModel = new User();
        $this->startSession();
    }

    private function startSession()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // public function create()
    // {
    //     $this->ensureLoggedIn();
    //     // Lấy các sân có trạng thái 'trống'
    //     $Yards = $this->YardModel->getAvailableYards();  
    //     $users = $this->userModel->getAllUsers();
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $this->processFormCreate();
    //     } else {
    //         $this->render('bookings\booking-form', ['Yards' => $Yards, 'users' =>$users]);
    //     }
    // }

    public function createForCustom($YardId)
    {
        $this->ensureLoggedIn();

        // Lấy thông tin người dùng hiện tại từ session
        $currentUser = $_SESSION['currentUser'];

        // Lấy thông tin sân từ ID
        $Yard = $this->YardModel->getYardById($YardId);

        if (!$Yard || $Yard['status'] !== 'trống') {
            $_SESSION['flash_message'] = 'Sân này đã được đặt! Mời bạn chọn sân khác';
            header('Location: /user/home/intro');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Xử lý form khi người dùng submit
            $checkInDate = $_POST['check_in'];
            $checkOutDate = $_POST['check_out'];
            $currentDate = date('Y-m-d');

            // Kiểm tra ngày hợp lệ
            if ($checkInDate < $currentDate || $checkOutDate < $currentDate) {
                header("Location: /booking/TaoBooking/$YardId");
                exit();
            }

            if ($checkInDate > $checkOutDate) {
                header("Location: /booking/TaoBooking/$YardId");
                exit();
            }

            $status = 'xác nhận';
            $booking = $this->bookingModel->createBooking($currentUser['id'], $YardId, $checkInDate, $checkOutDate, $status);

            if ($booking) {
                // Cập nhật trạng thái sân
                $this->YardModel->updateYardStatus($YardId, 'bận');
                $_SESSION['flash_message'] = 'Đặt sân thành công.';
                header('Location: /user/home/intro');
                exit();
            } else {
                $_SESSION['flash_message'] = 'Đặt sân thất bại. Hãy thử lại.';
            }
        }

    // Render form với thông tin user và Yard
    $this->render('bookings\Customer', [
        'booking' => null,
        'Yard' => $Yard,
        'user' => $currentUser,
    ]);
}
    private function processFormCreate()
    {
        $userId = $_POST['user_id'];
        $YardId = $_POST['YardID'];
        $checkInDate = $_POST['check_in'];
        $checkOutDate = $_POST['check_out'];
        
        // Tạo booking với trạng thái 'booked'
        $status = 'xác nhận';
        $booking = $this->bookingModel->createBooking($userId, $YardId, $checkInDate, $checkOutDate, $status);

        if ($booking) {
            // Cập nhật trạng thái sân thành 'bận' sau khi tạo booking
            $this->YardModel->updateYardStatus($YardId, 'bận');
            
            // Chuyển hướng sau khi tạo booking thành công
            $_SESSION['flash_message'] = 'Đặt sân thành công.';

            if ($_SESSION['currentUser']['role'] === 'customer') {
                header('Location: /user/home/intro');
            } else {
                header('Location: /booking/list');
            }
            exit();
        } else {
            echo 'Đặt sân thất bại. Hãy thử lại.';
        }
    }

    public function cancel($bookingId)
    {
        $this->ensureLoggedIn();
        
        // Lấy thông tin booking theo bookingId
        $booking = $this->bookingModel->getBookingById($bookingId);
    
        // Lấy YardId từ booking và cập nhật trạng thái sân
        $YardId = $booking['yardID'];
        $this->YardModel->updateYardStatus($YardId, 'trống');
        
        // Cập nhật trạng thái booking thành 'cancelled'
        $this->bookingModel->updateBookingStatus($bookingId, 'hủy');
        
        // Lấy thông tin người dùng từ session (hoặc database nếu cần)
        $userId = $_SESSION['currentUser']['id']; // Giả sử bạn lưu thông tin người dùng trong session
        $user = $this->userModel->getUserById($userId); // Lấy thông tin người dùng từ database hoặc session
    
        if ($user && $user['role'] === 'customer') {
        // Nếu người dùng là customer, chuyển tới trang lịch sử booking của chính họ
            $_SESSION['flash_message'] = 'Hủy đặt sân thành công.';
            header('Location: /booking/history/' . $userId);
        } 
        exit();
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
    
    public function userBookingHistory($userId)
    {
            // Lấy danh sách bookings của người dùng với thông tin sân tương ứng
            $bookingModel = new Booking();
            $bookings = $bookingModel->getBookingsByUserId($userId);
        
            // Truyền dữ liệu vào view
            $this->render('bookings/booking-history', ['bookings' => $bookings]);
        
    }
    
}