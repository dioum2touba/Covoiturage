<?php
class Voiture
{

   // database connection and table name
   private $db;
   private $table_name = "voiture";
   private $imm ;
   private $type;
   private $nbrPlace;
   private $libelle;
   private $conducteurkey;

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

   public function getImm()
   {
      return $this->imm;
   }
   public function setImm($imm)
   {
      $this->imm = $imm;
   }

   public function getType()
   {
      return $this->type;
   }
   public function setType($type)
   {
      $this->type = $type;
   }

   public function getNbrPlace()
   {
      return $this->nbrPlace;
   }
   public function setNbrPlace($nbrPlace)
   {
      $this->nbrPlace = $nbrPlace;
   }

   public function getNombrePlace()
   {
      return $this->nombrePlace;
   }
   public function setNombrePlace($nombrePlace)
   {
      $this->nombrePlace = $nombrePlace;
   }

   public function getLibelle()
   {
      return $this->libelle;
   }
   public function setLibelle($libelle)
   {
      $this->libelle = $libelle;
   }

   public function getConducteurkey()
   {
      return $this->conducteurkey;
   }
   public function setConducteurkey($conducteurkey)
   {
      $this->conducteurkey = $conducteurkey;
   }

   // used when filling up the update product form
   function readOne()
   {

      // query to read single record
      $query = "SELECT
                  *
           FROM
               " . $this->table_name;

      // prepare query statement
      $stmt = $this->db->prepare($query);

      // bind id of product to be updated
      $stmt->bindParam(1, $this->imm);

      // execute query
      $stmt->execute();

      // get retrieved row
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      //var_dump($row);
      // set values to object properties
      $this->imm = $row['imm'];
      $this->type = $row['type'];
      $this->nbrPlace = $row['nbrPlace'];
      $this->libelle = $row['libelle'];
      $this->conducteurkey  = $row['conducteurkey'];
   }
}
