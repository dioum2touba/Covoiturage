<?php
function inserer_client(Client $e,$db)
{

	$req="insert into client(nom,prenom,telephone,email,adresse,login,mdp,sexe) values (?,?,?, ?,?,?,?,?)";
	$st=$db->prepare($req);	
	$st->bindValue(1,$e->getNom());
    $st->bindValue(2,$e->getPrenom()); 
	$st->bindValue(3,$e->getTelephone()); 
	$st->bindValue(4,$e->getEmail()); 
	$st->bindValue(5,$e->getAdresse()); 
    $st->bindValue(6,$e->getLogin()); 
    $st->bindValue(7,$e->getMdp()); 
	$st->bindValue(8,$e->getSexe()); 
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

?>