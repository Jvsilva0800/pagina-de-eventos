<?php

require_once 'DatabaseConnection.php';

class Event {
  private $id;
  private $title;
  private $description;
  private $date;
  private $time;
  private $location;
  private $category;
  private $price;
  private $images;

  public function __construct($id, $title, $description, $date, $time, $location, $category, $price, $images) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->date = $date;
    $this->time = $time;
    $this->location = $location;
    $this->category = $category;
    $this->price = $price;
    $this->images = $images;
  }

  // Getters
  public function getId() {
    return $this->id;
  }

  public function getTitle() {
    return $this->title;
  }

  public function getDescription() {
    return $this->description;
  }

  public function getDate() {
    return $this->date;
  }

  public function getTime() {
    return $this->time;
  }

  public function getLocation() {
    return $this->location;
  }

  public function getCategory() {
    return $this->category;
  }

  public function getPrice() {
    return $this->price;
  }

  public function getImages() {
    return $this->images;
  }

  // Setters
  public function setTitle($title) {
    $this->title = $title;
  }

  public function setDescription($description) {
    $this->description = $description;
  }

  public function setDate($date) {
    $this->date = $date;
  }

  public function setTime($time) {
    $this->time = $time;
  }

  public function setLocation($location) {
    $this->location = $location;
  }

  public function setCategory($category) {
    $this->category = $category;
  }

  public function setPrice($price) {
    $this->price = $price;
  }

  public function setImages($images) {
    $this->images = $images;
  }

  // Save event to the database
  public function save() {
    $conn = DatabaseConnection::getConnection();

    $sql = "INSERT INTO events (title, description, date, time, location, category, price, images) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssds", $this->title, $this->description, $this->date, $this->time, $this->location, $this->category, $this->price, $this->images);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Update event in the database
  public function update() {
    $conn = DatabaseConnection::getConnection();

    $sql = "UPDATE events SET title = ?, description = ?, date = ?, time = ?, location = ?, category = ?, price = ?, images = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssdsi", $this->title, $this->description, $this->date, $this->time, $this->location, $this->category, $this->price, $this->images, $this->id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Delete event from the database
  public function delete() {
    $conn = DatabaseConnection::getConnection();

    $sql = "DELETE FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $this->id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Get a list of all events
  public static function getAllEvents() {
    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT * FROM events";
    $result = $conn->query($sql);

    $events = array();
    while ($row = $result->fetch_assoc()) {
      $event = new Event($row['id'], $row['title'], $row['description'], $row['date'], $row['time'], $row['location'], $row['category'], $row['price'], $row['images']);
      $events[] = $event;
    }

    $result->close();
    $conn->close();

    return $events;
  }

  // Get an event by its ID
  public static function getEventById($id) {
    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT * FROM events WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $event = null;
    if ($row = $result->fetch_assoc()) {
      $event = new Event($row['id'], $row['title'], $row['description'], $row['date'], $row['time'], $row['location'], $row['category'], $row['price'], $row['images']);
    }

    $stmt->close();
    $conn->close();

    return $event;
  }

}

?>
