<?php

namespace App\Models;

class User
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

    public function getAllUsers()
    {
        $result = $this->mysqli->query("SELECT * FROM users");
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById($userId)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $result = $this->mysqli->query("SELECT * FROM users WHERE id = $userId");

        return $result->fetch_assoc();
    }

    public function getUserByUsername($username)
    {
        $username = $this->mysqli->real_escape_string($username);
        $result = $this->mysqli->query("SELECT * FROM users WHERE username = '$username'");

        return $result->fetch_assoc();
    }

    public function createUser($username, $password, $fullname, $email, $phone, $role)
    {
        $username = $this->mysqli->real_escape_string($username);
        $password = $this->mysqli->real_escape_string($password);
        $fullname = $this->mysqli->real_escape_string($fullname);
        $email = $this->mysqli->real_escape_string($email);
        $phone = $this->mysqli->real_escape_string($phone);
        $role = $this->mysqli->real_escape_string($role);
    
        // SQL Query to insert new user into the database
        $sql = "INSERT INTO users (username, password, fullname, email, phone, role) 
                VALUES ('$username', '$password', '$fullname', '$email', '$phone', '$role')";
    
        return $this->mysqli->query($sql);
    }

    public function updateUser($userId, $username, $password, $fullname, $email, $phone, $role)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        $username = $this->mysqli->real_escape_string($username);
        $password = $this->mysqli->real_escape_string($password);
        $email = $this->mysqli->real_escape_string($email);
        $fullname = $this->mysqli->real_escape_string($fullname);
        $phone = $this->mysqli->real_escape_string($phone);
        
        if ($role !== 'admin') {
            $role = 'customer';
        }
        else {
            $role = $this->mysqli->real_escape_string($role);
        }

        // $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        return $this->mysqli->query("UPDATE users 
                                     SET username='$username', password='$password', fullname='$fullname', 
                                         email='$email', phone='$phone', role='$role' 
                                     WHERE id=$userId");
    }

    public function deleteUser($userId)
    {
        $userId = $this->mysqli->real_escape_string($userId);
        return $this->mysqli->query("DELETE FROM users WHERE id=$userId");
    }

        public function updateUserWithoutPassword($userId, $username, $fullname, $email, $phone, $role)
    {
        $username = $this->mysqli->real_escape_string($username);
        $fullname = $this->mysqli->real_escape_string($fullname);
        $email = $this->mysqli->real_escape_string($email);
        $phone = $this->mysqli->real_escape_string($phone);
        $role = $this->mysqli->real_escape_string($role);

        return $this->mysqli->query("UPDATE users SET username='$username', fullname='$fullname', email='$email', phone='$phone', role='$role' WHERE id=$userId");
    }

    public function search($searchTerm)
    {
        // Escape the search term to prevent SQL injection
        $searchTerm = $this->mysqli->real_escape_string($searchTerm);
    
        // SQL query to search users by username or full name
        $sql = "SELECT * FROM users WHERE username LIKE '%$searchTerm%' OR fullname LIKE '%$searchTerm%'";
    
        // Execute the query
        $result = $this->mysqli->query($sql);
    
        // Fetch all matching users
        return $result->fetch_all(MYSQLI_ASSOC);
    }
    
    public function isUsernameExists($username)
    {
        $username = $this->mysqli->real_escape_string($username);
        $sql = "SELECT COUNT(*) FROM users WHERE username = '$username'";
        $result = $this->mysqli->query($sql);
        
        // Fetch the result and return whether the username exists
        $row = $result->fetch_row();
        return $row[0] > 0;
    }
    
    public function isEmailExists($email)
    {
        $email = $this->mysqli->real_escape_string($email);
        $sql = "SELECT COUNT(*) FROM users WHERE email = '$email'";
        $result = $this->mysqli->query($sql);
        
        // Fetch the result and return whether the email exists
        $row = $result->fetch_row();
        return $row[0] > 0;
    }
    

}
