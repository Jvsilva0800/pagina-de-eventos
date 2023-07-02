<?php

require_once 'DatabaseConnection.php';

class User {
  private $id;
  private $name;
  private $email;
  private $password;

  public function __construct($id, $name, $email, $password) {
    $this->id = $id;
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
  }

  // Getters
  public function getId() {
    return $this->id;
  }

  public function getName() {
    return $this->name;
  }

  public function getEmail() {
    return $this->email;
  }

  public function getPassword() {
    return $this->password;
  }

  // Setters
  public function setName($name) {
    $this->name = $name;
  }

  public function setEmail($email) {
    $this->email = $email;
  }

  public function setPassword($password) {
    $this->password = $password;
  }

  // Save user to the database
  public function save() {
    $conn = DatabaseConnection::getConnection(); 

    $sql = "INSERT INTO users (name, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $this->name, $this->email, $this->password);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Update user in the database
  public function update() {
    $conn = DatabaseConnection::getConnection();

    $sql = "UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $this->name, $this->email, $this->password, $this->id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Delete user from the database
  public function delete() {
    $conn = DatabaseConnection::getConnection();

    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $this->id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Get a list of all users
  public static function getAllUsers() {
    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);

    $users = array();
    while ($row = $result->fetch_assoc()) {
      $user = new User($row['id'], $row['name'], $row['email'], $row['password']);
      $users[] = $user;
    }

    $result->close();
    $conn->close();

    return $users;
  }

  // Get a user by their ID
  public static function getUserById($id) {
    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = null;
    if ($row = $result->fetch_assoc()) {
      $user = new User($row['id'], $row['name'], $row['email'], $row['password']);
    }

    $stmt->close();
    $conn->close();

    return $user;
  }

  // Get a user by their email
  public static function getUserByEmail($email) {
    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    $user = null;
    if ($row = $result->fetch_assoc()) {
      $user = new User($row['id'], $row['name'], $row['email'], $row['password']);
    }

    $stmt->close();
    $conn->close();

    return $user;
  }

  // Authenticate user login
  public static function authenticate($email, $password) {
    $user = self::getUserByEmail($email);

    if ($user && password_verify($password, $user->getPassword())) {
      return $user;
    }

    return null;
  }


}


?>
