<?php 
  class BeverageIngredientMapping{
    // DB Variables
    private $conn;
    private $table = 'beverage_ingredient_mapping';

    // Properties
    public $id;
    public $beverage_id;
    public $ingredient_id;
    public $amount;

    // Constructor with DB
    public function __construct($db) {
      $this->conn = $db;
    }

    // Tells if sufficient amount of ingredients are present to make a particular beverage 
    public function areIngredientsAvailable($id) {
        $query = "SELECT quantity 
                  FROM ingredients as i
                  INNER JOIN beverage_ingredient_mapping as bim ON (bim.ingredient_id = i.id)
                  WHERE bim.beverage_id = ? AND i.quantity < bim.amount";
                  
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        if($stmt->rowCount($stmt)) {
            return false;
        }
        return true;
    }

    // Return all the ingredients and their amount required to make a particular beverage
    public function getIngredientsByBeverageId($id) {
        $query = "SELECT ingredient_id,name, amount 
                  FROM beverage_ingredient_mapping as bim
                  INNER JOIN ingredients i ON (bim.ingredient_id = i.id)
                  WHERE bim.beverage_id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $ingredients = $stmt->fetchall(PDO::FETCH_ASSOC);
        return $ingredients;
    }
    
  }