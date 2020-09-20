<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../../config/database.php';
include_once '../../mesclasses/Voiture.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare offre object
$voiture = new Voiture($db);
  
// set ID property of record to read
$id = isset($_GET['imm']) ? $_GET['imm'] : die();
$voiture->setImm($id);
// read the details of offre to be edited
$voiture->readOne();
  
if($voiture->getType()!=null){
    // create array
    $voiture_arr = array(
        "imm" =>  $voiture->getImm(),
        "type" => $voiture->getType(),
        "nbrPlace" => $voiture->getNbrPlace(),
        "libelle" => $voiture->getLibelle(),
        "conducteurkey" => $voiture->getConducteurkey()
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($voiture_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user offre does not exist
    echo json_encode(array("message" => "offre does not exist."));
}
