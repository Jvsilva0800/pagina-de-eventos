<?php

require_once 'DatabaseConnection.php';

class Authentication {
  
  
  public static function userExists($email) {
    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT COUNT(*) as count FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $row = $result->fetch_assoc();
    $count = $row['count'];

    $stmt->close();
    $conn->close();

    return $count > 0;
  }

  // Register a new user
  public static function registerUser($name, $email, $password) {
    if (self::userExists($email)) {
      return false; // User already exists
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $conn = DatabaseConnection::getConnection();

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $hashedPassword);
    $stmt->execute();

    $stmt->close();
    $conn->close();

    return true;
  }

  // Authenticate user login
  public static function authenticate($email, $password) {
    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = null;
    if ($row = $result->fetch_assoc()) {
      $hashedPassword = $row['password'];
      if (password_verify($password, $hashedPassword)) {
        $user = new User($row['id'], $row['name'], $row['email'], $hashedPassword);
      }
    }

    $stmt->close();
    $conn->close();

    return $user;
  }
}

?>
