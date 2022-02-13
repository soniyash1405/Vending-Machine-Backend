<?php 
  class Beverages{
    // DB Variables
    private $conn;
    private $table = 'beverages';

    // Properties
    public $id;
    public $name;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Returns all the beverages that can be obtained from vending machine
    public function getAllBeverages() {
      $query = "SELECT * FROM $this->table";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $beverageNames = $stmt->fetchall(PDO::FETCH_ASSOC);
      return $beverageNames;
    }

    // Returns the beverages name from beverage id
    public function getBeverageNameById($id) {
      $query = "SELECT name FROM $this->table WHERE id = ?";
      $stmt = $this->conn->prepare($query);
      $stmt->bindParam(1, $id);
      $stmt->execute();
      $beverageName = $stmt->fetch(PDO::FETCH_ASSOC);
      return $beverageName;
    }
  }