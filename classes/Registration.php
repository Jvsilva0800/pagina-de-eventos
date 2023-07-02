<?php

require_once 'DatabaseConnection.php';

class Registration {
  private $id;
  private $user;
  private $event;
  private $paymentStatus;

  public function __construct($id, $user, $event, $paymentStatus) {
    $this->id = $id;
    $this->user = $user;
    $this->event = $event;
    $this->paymentStatus = $paymentStatus;
  }

  // Getters
  public function getId() {
    return $this->id;
  }

  public function getUser() {
    return $this->user;
  }

  public function getEvent() {
    return $this->event;
  }

  public function getPaymentStatus() {
    return $this->paymentStatus;
  }

  // Setters
  public function setUser($user) {
    $this->user = $user;
  }

  public function setEvent($event) {
    $this->event = $event;
  }

  public function setPaymentStatus($paymentStatus) {
    $this->paymentStatus = $paymentStatus;
  }

  // Save registration to the database
  public function save() {
    $conn = DatabaseConnection::getConnection();

    $sql = "INSERT INTO registrations (user_id, event_id, payment_status) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis", $this->user->getId(), $this->event->getId(), $this->paymentStatus);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Update registration in the database
  public function update() {
    $conn = DatabaseConnection::getConnection();

    $sql = "UPDATE registrations SET user_id = ?, event_id = ?, payment_status = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iisi", $this->user->getId(), $this->event->getId(), $this->paymentStatus, $this->id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Delete registration from the database
  public function delete() {
    $conn = DatabaseConnection::getConnection();

    $sql = "DELETE FROM registrations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $this->id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Get a list of all registrations
  public static function getAllRegistrations() {
    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT * FROM registrations";
    $result = $conn->query($sql);

    $registrations = array();
    while ($row = $result->fetch_assoc()) {
      $user = User::getUserById($row['user_id']);
      $event = Event::getEventById($row['event_id']);

      $registration = new Registration($row['id'], $user, $event, $row['payment_status']);
      $registrations[] = $registration;
    }

    $result->close();
    $conn->close();

    return $registrations;
  }

  // Get a registration by its ID
  public static function getRegistrationById($id) {
    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT * FROM registrations WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $registration = null;
    if ($row = $result->fetch_assoc()) {
      $user = User::getUserById($row['user_id']);
      $event = Event::getEventById($row['event_id']);

      $registration = new Registration($row['id'], $user, $event, $row['payment_status']);
    }

    $stmt->close();
    $conn->close();

    return $registration;
  }

}

?>
