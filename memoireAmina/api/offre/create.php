<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection

include_once '../../config/database.php';
include_once '../../mesclasses/Offre.php';
  
$database = new Database();
$db = $database->getConnection();
  
$offre = new Offre($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
  
// make sure data is not empty
if(
    !empty($data->nomTrajet) &&
    !empty($data->date_heure) &&
    !empty($data->nombrePlace) &&
    !empty($data->voitureid) &&
    !empty($data->conducteurId)
){
    // set product property values
    $offre->setNomTrajet($data->nomTrajet);
    $offre->setDate_Heure($data->date_heure);
    $offre->setNombrePlace($data->nombrePlace);
    $offre->setVoiture( $data->voitureid);
    $offre->setConducteurId($data->conducteurId);
  
   // create the product
    if($offre->create()){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("message" => "Product was created."));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("message" => "Unable to create product."));
    }
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("message" => "Unable to create product. Data is incomplete."));
}
?>