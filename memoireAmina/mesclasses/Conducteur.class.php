<?php
class Conducteur{

    private $nom;
    private $prenom;
    private $telephone;
    private $email;
    private $adresse;
    private $login;
    private $mdp;
    private $sexe;
    private $idclient;
    public function __construct($nom,$prenom,$telephone,$email,$adresse,$login,$mdp,$sexe){

       $this->nom= $nom;
       $this->prenom= $prenom;
       $this->telephone= $telephone;
       $this->email= $email;
       $this->adresse= $adresse;
       $this->login= $login;
       $this->mdp= $mdp;
       $this->sexe= $sexe;
    } 
    public function getNom(){return $this->nom;}
    public function setNom($nom){$this->nom= $nom;}
    public function getPrenom(){return $this->prenom;}
    public function setPrenom($prenom){$this->prenom= $prenom;}
    public function getTelephone(){return $this->telephone;}
    public function setTelephone($telephone){$this->telephone= $telephone;}
    public function getEmail(){return $this->email;}
    public function setEmail($email){$this->email= $email;}
    public function getAdresse(){return $this->adresse;}
    public function setAdresse($adresse){$this->adresse= $adresse;}
    public function getLogin(){return $this->login;}
    public function setLogin($login){$this->login= $login;}
    public function getMdp(){return $this->mdp;}
    public function setMdp($mdp){$this->mdp= $mdp;}
    public function getSexe(){return $this->sexe;}
    public function setSexe($sexe){$this->sexe= $sexe;}
    public function getIdclient(){return $this->idclient;}
    public function setIdclient($idclient){$this->idclient= $idclient;}

    function inserer_conducteur($db)
  {

     $req="insert into conducteur(nom,prenom,telephone,email,adresse,login,mdp,sexe) values (?,?,?, ?,?,?,?,?)";
     $st=$db->prepare($req); 
     $st->bindValue(1,$this->getNom());
     $st->bindValue(2,$this->getPrenom()); 
     $st->bindValue(3,$this->getTelephone()); 
     $st->bindValue(4,$this->getEmail()); 
     $st->bindValue(5,$this->getAdresse()); 
     $st->bindValue(6,$this->getLogin()); 
     $st->bindValue(7,$this->getMdp()); 
     $st->bindValue(8,$this->getSexe()); 
     $db->beginTransaction();
     $res=$st->execute();
     if($res==1)
     {
        $id=$db->lastInsertId();
      }
      else $id=0;
      $db->commit();
      return $id;
        
  }
}

?>