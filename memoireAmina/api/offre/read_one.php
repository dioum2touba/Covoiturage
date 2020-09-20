<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// include database and object files
include_once '../../config/database.php';
include_once '../../mesclasses/Offre.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare offre object
$offre = new Offre($db);
  
// set ID property of record to read
$id = isset($_GET['id']) ? $_GET['id'] : die();
$offre->setId($id);
// read the details of offre to be edited
$offre->readOne();
  
if($offre->getNomTrajet()!=null){
    // create array
    $offre_arr = array(
        "id" =>  $offre->getId(),
        "nomTrajet" => $offre->getNomTrajet(),
        "date_heure" => $offre->getDate_Heure(),
        "nombrePlace" => $offre->getNombrePlace(),
        "voitureid" => $offre->getVoiture(),
        "conducteurId" => $offre->getConducteurId()
  
    );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($offre_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user offre does not exist
    echo json_encode(array("message" => "offre does not exist."));
}
