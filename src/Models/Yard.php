<?php

namespace App\Models;

class Yard
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

    public function getAllYards()
    {
        $result = $this->mysqli->query("SELECT * FROM Yards");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getYardById($YardId)
    {
        $YardId = $this->mysqli->real_escape_string($YardId);
        $result = $this->mysqli->query("SELECT * FROM Yards WHERE id = $YardId");

        return $result->fetch_assoc();
    }

    public function getYardNameById($YardId)
    {
        if ($YardId === null) {
            return null; // Nếu YardId là null, trả về null
        }
    
        // Sử dụng MySQLi để chuẩn bị và thực thi truy vấn
        $stmt = $this->mysqli->prepare("SELECT name FROM Yards WHERE id = ?");
        $stmt->bind_param("i", $YardId); // Bind YardId với kiểu dữ liệu integer
        $stmt->execute();
    
        // Lấy kết quả
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
    
        // Trả về tên sân nếu tìm thấy, nếu không thì trả về null
        return $row['name'] ?? null;
    }
    

    public function createYard($name, $description, $pricePerNight, $status)
    {
        $name = $this->mysqli->real_escape_string($name);
        $description = $this->mysqli->real_escape_string($description);
        $pricePerNight = $this->mysqli->real_escape_string($pricePerNight);
        $status = $this->mysqli->real_escape_string($status);

        return $this->mysqli->query("INSERT INTO Yards (name, description, price_per_night, status) 
                                     VALUES ('$name', '$description', '$pricePerNight', '$status')");
    }

    public function updateYard($YardId, $name, $description, $pricePerNight, $status)
    {
        $name = $this->mysqli->real_escape_string($name);
        $description = $this->mysqli->real_escape_string($description);
        $pricePerNight = $this->mysqli->real_escape_string($pricePerNight);
        $status = $this->mysqli->real_escape_string($status);

        return $this->mysqli->query("UPDATE Yards 
                                     SET name='$name', description='$description', 
                                         price_per_night='$pricePerNight', status='$status' 
                                     WHERE id=$YardId");
    }

    public function deleteYard($YardId)
    {
        $YardId = $this->mysqli->real_escape_string($YardId);
        return $this->mysqli->query("DELETE FROM Yards WHERE id=$YardId");
    }

    public function updateYardStatus($YardId, $status)
    {
        // Sanitize the input to prevent SQL injection
        $YardId = $this->mysqli->real_escape_string($YardId);
        $status = $this->mysqli->real_escape_string($status);
    
        // SQL query to update Yard status
        $sql = "UPDATE Yards SET status = '$status' WHERE id = $YardId";
    
        // Execute the query and check if it was successful
        return $this->mysqli->query($sql);
    }
    
    public function getAvailableYards()
    {
        $result = $this->mysqli->query("SELECT * FROM Yards WHERE status = 'available'");
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function searchYards($searchTerm)
    {
        $searchTerm = $this->mysqli->real_escape_string($searchTerm);
        
        // Query to search Yards by name or description
        $query = "SELECT * FROM Yards WHERE name LIKE '%$searchTerm%'";
        
        $result = $this->mysqli->query($query);
        
        // Return the Yards as an associative array
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getYardImageById($YardId)
    {
        $YardId = $this->mysqli->real_escape_string($YardId);

        $query = "
            SELECT image 
            FROM Yards 
            WHERE id = $YardId
        ";

        $result = $this->mysqli->query($query);
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['image'];
        }

        return null;  // Trả về null nếu không tìm thấy hình ảnh
    }
    
}
