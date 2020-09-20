<?php
class Offre
{

   // database connection and table name
   private $db;
   private $table_name = "offre";
   private $id;
   private $nomTrajet;
   private $date_heure;
   private $nombrePlace;
   private $voitureid;
   private $conducteurId;

   // constructor with $db as database connection
   public function __construct($db)
   {
      $this->db = $db;
   }

   //  public function __construct($nomTrajet,$date_heure,$nombrePlace,$voiture, $conducteurId){

   //     $this->nomTrajet= $nomTrajet;
   //     $this->date_heure= $date_heure;
   //     $this->nombrePlace= $nombrePlace;
   //     $this->voiture= $voiture;
   //     $this->conducteurId= $conducteurId;
   //  } 

   public function getId()
   {
      return $this->id;
   }
   public function setId($id)
   {
      $this->id = $id;
   }

   public function getNomTrajet()
   {
      return $this->nomTrajet;
   }
   public function setNomTrajet($nomTrajet)
   {
      $this->nomTrajet = $nomTrajet;
   }

   public function getDate_Heure()
   {
      return $this->date_heure;
   }
   public function setDate_Heure($date_heure)
   {
      $this->date_heure = $date_heure;
   }

   public function getNombrePlace()
   {
      return $this->nombrePlace;
   }
   public function setNombrePlace($nombrePlace)
   {
      $this->nombrePlace = $nombrePlace;
   }

   public function getVoiture()
   {
      return $this->voitureid;
   }
   public function setVoiture($voitureid)
   {
      $this->voitureid = $voitureid;
   }

   public function getConducteurId()
   {
      return $this->conducteurId;
   }
   public function setConducteurId($conducteurId)
   {
      $this->conducteurId = $conducteurId;
   }

   // read products
   function read()
   {

      // select all query
      $query = "SELECT *  FROM " . $this->table_name;

      // prepare query statement
      $stmt = $this->db->prepare($query);

      // execute query
      $stmt->execute();

      return $stmt;
   }

   // create product
   function create()
   {

      // query to insert record
      $query = "INSERT INTO
                  " . $this->table_name . "
            SET
            nomtrajet=:nomTrajet, date_heure=:date_heure, nombreplace=:nombreplace, voitureid=:voitureid, conducteurid=:conducteurid";

      // prepare query
      // prepare query
      $stmt = $this->db->prepare($query);

      // sanitize
      $this->nomTrajet = htmlspecialchars(strip_tags($this->nomTrajet));
      $this->date_heure = htmlspecialchars(strip_tags($this->date_heure));
      $this->nombrePlace = htmlspecialchars(strip_tags($this->nombrePlace));
      $this->voitureid = htmlspecialchars(strip_tags($this->voitureid));
      $this->conducteurId = htmlspecialchars(strip_tags($this->conducteurId));

      // bind values
      $stmt->bindParam(":nomTrajet", $this->nomTrajet);
      $stmt->bindParam(":date_heure", $this->date_heure);
      $stmt->bindParam(":nombreplace", $this->nombrePlace);
      $stmt->bindParam(":voitureid", $this->voitureid);
      $stmt->bindParam(":conducteurid", $this->conducteurId);

      // execute query
      if ($stmt->execute()) {
         return true;
      }

      return false;
   }

   // used when filling up the update product form
   function readOne()
   {

      // query to read single record
      $query = "SELECT
                  *
           FROM
               " . $this->table_name . " where id = ?";

      // prepare query statement
      $stmt = $this->db->prepare($query);

      // bind id of product to be updated
      $stmt->bindParam(1, $this->id);

      // execute query
      $stmt->execute();

      // get retrieved row
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // set values to object properties
      $this->nomTrajet = $row['NomTrajet'];
      $this->date_heure = $row['Date_Heure'];
      $this->nombrePlace = $row['NombrePlace'];
      $this->voitureid = $row['VoitureId'];
      $this->conducteurId = $row['ConducteurId'];
   }

   // update the product
   function update()
   {

      // update query
      $query = "UPDATE
               " . $this->table_name . "
            SET
            nomtrajet=:nomTrajet, 
            date_heure=:date_heure, 
            nombreplace=:nombreplace, 
            voitureid=:voitureid, 
            conducteurid=:conducteurid
           WHERE
               id = :id";

      // prepare query statement
      $stmt = $this->db->prepare($query);

      // sanitize
      $this->nomTrajet = htmlspecialchars(strip_tags($this->nomTrajet));
      $this->date_heure = htmlspecialchars(strip_tags($this->date_heure));
      $this->nombrePlace = htmlspecialchars(strip_tags($this->nombrePlace));
      $this->voitureid = htmlspecialchars(strip_tags($this->voitureid));
      $this->conducteurId = htmlspecialchars(strip_tags($this->conducteurId));

      // bind values
      $stmt->bindParam(":id", $this->id);
      $stmt->bindParam(":nomTrajet", $this->nomTrajet);
      $stmt->bindParam(":date_heure", $this->date_heure);
      $stmt->bindParam(":nombreplace", $this->nombrePlace);
      $stmt->bindParam(":voitureid", $this->voitureid);
      $stmt->bindParam(":conducteurid", $this->conducteurId);

      // execute the query
      if ($stmt->execute()) {
         return true;
      }

      return false;
   }

   // delete the product
   function delete()
   {

      // delete query
      $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

      // prepare query
      $stmt = $this->db->prepare($query);

      // sanitize
      $this->id = htmlspecialchars(strip_tags($this->id));

      // bind id of record to delete
      $stmt->bindParam(1, $this->id);

      // execute query
      if ($stmt->execute()) {
         return true;
      }

      return false;
   }
}
