<?php
error_reporting(1);
include_once PROJECT_ROOT_PATH . "/services/VendingMachineServices.php";

class VendingMachineController {

    private $requestMethod;
    private $requestParameters;
    private $vendingMachineServices;

    public function __construct($requestMethod, $requestParameters) {
        $this->requestMethod = $requestMethod;
        $this->requestParameters = $requestParameters;
        $this->vendingMachineServices = new VendingMachineServices();
    }

    // process all the api requests and return response
    public function processRequest() {
        switch ($this->requestMethod) {
            
            case 'refill':
                $refillArray = $this->requestParameters;
                $response = $this->vendingMachineServices->refillIngredients($refillArray);
                break;
            case 'order':
                $id = $this->requestParameters['id'];
                $response = $this->vendingMachineServices->placeOrder($id);
                break;
            case 'allBeverages':
                $response = $this->vendingMachineServices->showBeverages();
                break;
            case 'allIngredients':
                $response = $this->vendingMachineServices->showIngredients();
                break;
            case 'beverageNameById':
                $id = $this->requestParameters['id'];
                $response = $this->vendingMachineServices->showBeverageNameById($id);
                break;
            case 'ingredientsOfBeverage':
                $id = $this->requestParameters['id'];
                $response = $this->vendingMachineServices->getIngredientsOfBeverage($id);
                break;
            default:
                $response = $this->vendingMachineServices->invalidApi();
                break;
        }

        if($response['msg_type'] === 'error') {
            $this->send_response_message([],"error",true,[$response['msg']]);
        } else {
            $this->send_response_message([$response['data']],"success",false,[]);
        }
    }

    // Sends all the responses of api in json format
    function send_response_message($data, $status, $hasError, $error) {
        if(empty($data)) {
            $data=[];
        }
        echo json_encode(array(
            "data" => $data,
            "status" => $status,
            "hasError" => $hasError,
            "errors" =>$error
        ));
    }
}

?>