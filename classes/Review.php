<?php

require_once 'DatabaseConnection.php';

class Review {
  private $id;
  private $user;
  private $event;
  private $rating;
  private $comment;

  public function __construct($id, $user, $event, $rating, $comment) {
    $this->id = $id;
    $this->user = $user;
    $this->event = $event;
    $this->rating = $rating;
    $this->comment = $comment;
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

  public function getRating() {
    return $this->rating;
  }

  public function getComment() {
    return $this->comment;
  }

  // Setters
  public function setUser($user) {
    $this->user = $user;
  }

  public function setEvent($event) {
    $this->event = $event;
  }

  public function setRating($rating) {
    $this->rating = $rating;
  }

  public function setComment($comment) {
    $this->comment = $comment;
  }

  // Save review to the database
  public function save() {
    $conn = DatabaseConnection::getConnection();

    $sql = "INSERT INTO reviews (user_id, event_id, rating, comment) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiss", $this->user->getId(), $this->event->getId(), $this->rating, $this->comment);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Update review in the database
  public function update() {
    $conn = DatabaseConnection::getConnection();

    $sql = "UPDATE reviews SET user_id = ?, event_id = ?, rating = ?, comment = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iissi", $this->user->getId(), $this->event->getId(), $this->rating, $this->comment, $this->id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Delete review from the database
  public function delete() {
    $conn = DatabaseConnection::getConnection();

    $sql = "DELETE FROM reviews WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $this->id);
    $stmt->execute();

    $stmt->close();
    $conn->close();
  }

  // Get a list of all reviews
  public static function getAllReviews() {
    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT * FROM reviews";
    $result = $conn->query($sql);

    $reviews = array();
    while ($row = $result->fetch_assoc()) {
      $user = User::getUserById($row['user_id']);
      $event = Event::getEventById($row['event_id']);

      $review = new Review($row['id'], $user, $event, $row['rating'], $row['comment']);
      $reviews[] = $review;
    }

    $result->close();
    $conn->close();

    return $reviews;
  }

  // Get a review by its ID
  public static function getReviewById($id) {
    $conn = DatabaseConnection::getConnection();

    $sql = "SELECT * FROM reviews WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $review = null;
    if ($row = $result->fetch_assoc()) {
      $user = User::getUserById($row['user_id']);
      $event = Event::getEventById($row['event_id']);

      $review = new Review($row['id'], $user, $event, $row['rating'], $row['comment']);
    }

    $stmt->close();
    $conn->close();

    return $review;
  }

}

?>
