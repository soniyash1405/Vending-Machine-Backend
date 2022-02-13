<?php
error_reporting(1);
define("PROJECT_ROOT_PATH", __DIR__);
 
include_once PROJECT_ROOT_PATH . "/Controller/VendingMachineController.php";

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

// all of our endpoints start with /nestaway, everything else results in a 404 Not Found
if ($uri[1] !== 'nestaway' || $uri[2] !== 'assignment') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$apiName = $uri[4];
$requestBody = file_get_contents("php://input");
$requestBodyArray = "";
if(!empty($requestBody)){
    $requestBodyArray = json_decode($requestBody, true);
}

// pass the api to be called and request body parameters to the VendingMachineController and process the request:
$controller = new VendingMachineController($apiName, $requestBodyArray);
$controller->processRequest();
?>