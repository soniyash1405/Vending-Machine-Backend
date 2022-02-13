<?php
  class Ingredients {
    // DB Variables
    private $conn;
    private $table = 'ingredients';

    // Properties
    public $id;
    public $name;
    public $quantity;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Returns all the ingredients present in vending machine
    public function getAllIngredients() {
      $query = "SELECT * FROM $this->table";
      $stmt = $this->conn->prepare($query);
      $stmt->execute();
      $ingredientNames = $stmt->fetchall(PDO::FETCH_ASSOC);
      return $ingredientNames;
    }

    // Updates the quantity of ingredients present in vending machine
    public function updateIngredientQuantity($input) {
      $setCondition = "";
      $nameArray = "";

      foreach ($input as $name => $quantity) {
        if($quantity > 500) {
          return false;
        }
        $setCondition .= " WHEN name = '$name' THEN " .$quantity;
        $nameArray .= "'". $name . "',";
      }
      $nameArray = substr($nameArray, 0, -1);
 
      $query = "UPDATE $this->table
                SET quantity = CASE
                $setCondition
                END
                WHERE name IN ($nameArray)";

      $stmt = $this->conn->prepare($query);
      if($stmt->execute()) {
        return true;
      }
      return false;
    }
  }
