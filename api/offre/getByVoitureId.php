<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
// include database and object files
include_once '../../config/database.php';
include_once '../../mesclasses/Offre.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$offre = new Offre($db);
  
// read products will be here
// query products
$stmt = $offre->read();
$num = $stmt->rowCount();
  
// check if more than 0 record found
if($num>0){
  
    // products array
    $offres_arr=array();
    $offres_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // // just $name only
        // extract($row);
  
        // $product_item=array(
        //     "id" => $row['id'],
        //     "nomTrajet" => $nomTrajet,
        //     "description" => $date_heure,
        //     "nombrePlace" => $nombrePlace,
        //     "voiture" => $voiture,
        //     "conducteurId" => $conducteurId
        // );
  
        array_push($offres_arr["records"], $row);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($offres_arr);
}
else
{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No products found.")
    );
}
  
// no products found will be here

?>