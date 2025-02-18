<?php

namespace App\Models;

class booking
{
    private $mysqli;

    public function __construct()
    {
        // Replace these values with your actual database configuration
        $host = DB_HOST;
        $username = DB_USER;
        $password = DB_PASSWORD;
        $database = DB_NAME;

        $this->mysqli = new \mysqli($host, $username, $password, $database);

        // Check connection
        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function getAllBookings()
    {
        $result = $this->mysqli->query("SELECT * FROM bookings");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getBookingById($bookingId)
    {
        $bookingId = $this->mysqli->real_escape_string($bookingId);
        $result = $this->mysqli->query("SELECT * FROM bookings WHERE id = $bookingId");

        return $result->fetch_assoc();
    }

    public function getYardNameByBookingId($bookingId)
    {
        // Lấy thông tin sân dựa vào booking ID
        $bookingId = $this->mysqli->real_escape_string($bookingId);
        $query = "
            SELECT Yards.name 
            FROM bookings
            INNER JOIN Yards ON bookings.YardID = Yards.id
            WHERE bookings.id = $bookingId
        ";
        
        $result = $this->mysqli->query($query);
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['name'];
        }

        return null;
    }

    public function getNameByUserId($bookingId)
    {
        // Lấy thông tin sân dựa vào booking ID
        $bookingId = $this->mysqli->real_escape_string($bookingId);
        $query = "
            SELECT Users.username 
            FROM bookings
            INNER JOIN Users ON bookings.userID = Users.id
            WHERE bookings.id = $bookingId
        ";
        
        $result = $this->mysqli->query($query);
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['username'];
        }

        return null;
    }

    public function createBooking($userId, $YardId, $checkInDate, $checkOutDate, $status)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $YardId = $this->mysqli->real_escape_string($YardId);
        $checkInDate = $this->mysqli->real_escape_string($checkInDate);
        $checkOutDate = $this->mysqli->real_escape_string($checkOutDate);
        $status = $this->mysqli->real_escape_string($status);

        return $this->mysqli->query("INSERT INTO bookings (userID, YardID, check_in, check_out, status) 
                                     VALUES ('$userId', '$YardId', '$checkInDate', '$checkOutDate', '$status')");
    }
    

    public function deleteBooking($bookingId)
    {
        $bookingId = $this->mysqli->real_escape_string($bookingId);
        return $this->mysqli->query("DELETE FROM bookings WHERE id=$bookingId");
    }

    public function updateBookingStatus($bookingId, $status)
    {
        
        $bookingId = $this->mysqli->real_escape_string($bookingId);
        $status = $this->mysqli->real_escape_string($status);
       
        $sql = "UPDATE bookings SET status = '$status' WHERE id = $bookingId";

        return $this->mysqli->query($sql);
    }

    public function getBookingsByUserId($userId)
    {
        // Escape the userId to prevent SQL injection
        $userId = $this->mysqli->real_escape_string($userId);
    
        // Query to fetch bookings for a specific user
        $query = "
            SELECT 
                b.id AS booking_id,
                b.check_in,
                b.check_out,
                b.date_booking,
                b.status,
                r.name AS Yard_name,
                r.description AS Yard_description,
                r.price_per_hour,
                r.image AS Yard_image
            FROM bookings b
            INNER JOIN Yards r ON b.YardID = r.id
            WHERE b.userID = '$userId'
            ORDER BY b.date_booking DESC
        ";
    
        // Execute the query
        $result = $this->mysqli->query($query);
    
        // Check if results exist
        if ($result && $result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    
        // Return an empty array if no results found
        return [];
    }
    
    

    
}
