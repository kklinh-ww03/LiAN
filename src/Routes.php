<?php

use App\Controllers\AuthenticationController;
use App\Router;
use App\Controllers\UserController;
use App\Controllers\YardController;
use App\Controllers\BookingController;
use App\Controllers\homeController;

// Usage:
$router = new Router();

// Routes cho User
$router->addRoute('/\//', [new UserController(), 'index']); // Trang chính của User (User Dashboard)
// $router->addRoute('/\/user\/index/', [new UserController(), 'userList']); 
$router->addRoute('/\/user\/home/', [new UserController(), 'userHome']); // Danh sách người dùng
$router->addRoute('/\/user\/create/', [new UserController(), 'create']); // Tạo người dùng mới
$router->addRoute('/\/user\/update\/(\d+)/', [new UserController(), 'update']); // Cập nhật người dùng theo ID
$router->addRoute('/\/user\/signin/', [new UserController(), 'signin']); // Đăng nhập người dùng
$router->addRoute('/\/user\/logout/', [new UserController(), 'logout']); // Đăng xuất người dùng
$router->addRoute('/\/user\/logup/', [new UserController(), 'registerUser']);
$router->addRoute('/\/user\/profile/', [new UserController(), 'profile']);

// Routes cho Yard
$router->addRoute('/\/Yard\/list/', [new YardController(), 'YardList']); // Danh sách sân
$router->addRoute('/\/Yard\/details\/(\d+)/', [new YardController(), 'details']); // Xem chi tiết sân

// Routes cho Booking
$router->addRoute('/\/booking\/list/', [new BookingController(), 'bookingList']); // Danh sách đặt sân
$router->addRoute('/\/booking\/TaoBooking\/(\d+)/', [new BookingController(), 'createForCustom']); // Tạo đặt sân mới
// $router->addRoute('/\/booking\/update\/(\d+)/', [new BookingController(), 'update']); // Chỉnh sửa booking theo ID
// $router->addRoute('/\/booking\/delete\/(\d+)/', [new BookingController(), 'delete']); // Xóa booking theo ID
$router->addRoute('/\/booking\/cancel\/(\d+)/', [new BookingController(), 'cancel']); // Hủy booking
$router->addRoute('/\/booking\/history\/(\d+)/', [new BookingController(), 'userBookingHistory']);// Lịch đặt sân

// Route cho trang Booking
$router->addRoute('/\/home\/intro/', [new homeController(), 'index']);//Đặt sân

// Routes cho Authentication
$router->addRoute('/\/auth\/validate/', [new AuthenticationController(), 'authenticate']); // Xác thực người dùng
