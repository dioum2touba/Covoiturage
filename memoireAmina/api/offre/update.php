<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../../config/database.php';
include_once '../../mesclasses/Offre.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$offre = new Offre($db);
  
// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));
  
// set ID property of product to be edited
$offre->setId($data->id);
$offre->setNomTrajet($data->nomTrajet);
$offre->setDate_Heure($data->date_heure);
$offre->setNombrePlace($data->nombrePlace);
$offre->setVoiture( $data->voitureid);
$offre->setConducteurId($data->conducteurId);
  
// update the product
if($offre->update()){
  
    // set response code - 200 ok
    http_response_code(200);
  
    // tell the user
    echo json_encode(array("message" => "offre was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update offre."));
}
?>