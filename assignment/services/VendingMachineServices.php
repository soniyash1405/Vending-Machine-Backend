<?php
error_reporting(1);

include_once PROJECT_ROOT_PATH. '/config/Database.php';
include_once PROJECT_ROOT_PATH. '/models/Ingredients.php';
include_once PROJECT_ROOT_PATH. '/models/Beverages.php';
include_once PROJECT_ROOT_PATH. '/models/BeverageIngredientMapping.php';

class VendingMachineServices {

    public $db;

    public function __construct()
    {
        $database = new Database();
        $this->db = $database->connect();
    }

    // Refills the ingredients of vending machine with input quantities
    public function refillIngredients($refillArray) {
        if($this->updateIngredientQuantity($refillArray)) {
            $response['msg_type'] = 'success';
            $response['data'] = "Refill Complete.";
        }
        else {
            $response['msg_type'] = 'error';
            $response['msg'] = "Ingredient quantity should be from 0 to 500";
        }

        return $response;
    }

    // Places the order of the input beverage and returns response
    public function placeOrder($id) {
        if($this->areIngredientsAvailable($id)) {
            $OriginalIngredientsAmount = $this->showIngredients()['data'];
            $ingredientsAmountToReduce = $this->getIngredientsOfBeverage($id)['data'];

            $newIngredientsAmount = array();
            foreach($OriginalIngredientsAmount as $key1 => $value1) {
                foreach($ingredientsAmountToReduce as $key2 => $value2) {
                    if($value1['id'] == $value2['ingredient_id']) {
                        $newIngredientsAmount[$value1['name']] = $value1['quantity'] - $value2['amount'];
                    }    
                }
            }

            if($this->updateIngredientQuantity($newIngredientsAmount)) {
                $response['data'] = ["Order Complete. Enjoy Your Coffee."];
                $response['msg_type'] = 'success';
            }
            else {
                $response['msg_type'] = 'error';
                $response['msg'] = "Something went wrong, please try again.";
            }
        }
        else {
            $response['msg_type'] = 'error';
            $response['msg'] = "Insufficient ingredients to complete the order. Please refill.";
        }

        return $response;       
    }
    
    // Checks all the ingredients present in the vending machine and returns response
    public function showIngredients() {
        $ingredientObject = new Ingredients($this->db);
        $ingredientList['data'] = $ingredientObject->getAllIngredients();
        
        if(!empty($ingredientList['data'])) {
            $ingredientList['msg_type'] = 'success';
        }
        else {
            $ingredientList['msg_type'] = 'error';
            $ingredientList['msg'] = "Something went wrong, please try again.";
        }

        return $ingredientList;
    }

    // Checks all the beverages present in the vending machine and returns response
    public function showBeverages() {
        $beverageObject = new Beverages($this->db);
        $beverageList['data'] = $beverageObject->getAllBeverages();

        if(!empty($beverageList['data'])) {
            $beverageList['msg_type'] = 'success';
        }
        else {
            $beverageList['msg_type'] = 'error';
            $beverageList['msg'] = "Something went wrong, please try again.";
        }

        return $beverageList;      
    }

    // Tells the name of the input beverage by its id
    public function showBeverageNameById($id) {
        $beverageObject = new Beverages($this->db);
        $beverage['data'] = $beverageObject->getBeverageNameById($id);

        if(!empty($beverage['data'])) {
            $beverage['msg_type'] = 'success';
        }
        else {
            $beverage['msg_type'] = 'error';
            $beverage['msg'] = "Invalid input, please try again.";
        }

        return $beverage;     
    }

    // Returns response when invalid endpoint is entered in api
    public function invalidApi() {
        $notFound['msg_type'] = 'error';
        $notFound['msg'] = "Invalid API Endpoint";
        return $notFound;
    }
    
    // Return all the ingredients and their amount required to make a particular beverage
    public function getIngredientsOfBeverage($id) {
        $object = new BeverageIngredientMapping($this->db);
        $ingredientList['data'] = $object->getIngredientsByBeverageId($id);
        if(!empty($ingredientList['data'])) {
            $ingredientList['msg_type'] = 'success';
        }
        else {
            $ingredientList['msg_type'] = 'error';
            $ingredientList['msg'] = "Something went wrong, please try again.";
        }

        return $ingredientList;
    }

    // Tells if sufficient amount of ingredients are present to make a particular beverage 
    private function areIngredientsAvailable($id) {
        $object = new BeverageIngredientMapping($this->db);
        $response = $object->areIngredientsAvailable($id);
        return $response;
    }

    // Updates the ingredients quantities of vending machine with input quantities
    private function updateIngredientQuantity($refillArray) {
        $ingredientObject = new Ingredients($this->db);
        $response = $ingredientObject->updateIngredientQuantity($refillArray);
        return $response;
    }
}
?>
