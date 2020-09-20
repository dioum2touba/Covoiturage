<?php

	require("mabase/dbconnexion.php");
	spl_autoload_register( function ($class) {
    include("./mesclasses/".$class.'.class.php');
    } );

    if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["telephone"]) && isset($_POST["mail"]) && isset($_POST["adresse"]) && isset($_POST["login"]) && isset($_POST["mdp1"]) && isset($_POST["mdp2"]) && isset($_POST["sexe"]) && isset($_POST["role"]))
    {
     	$nom=addslashes($_POST['nom']);
    	$prenom=addslashes($_POST['prenom']);
    	$telephone=addslashes($_POST['telephone']);
    	$mail=addslashes($_POST['mail']);
   		$adresse=addslashes($_POST['adresse']); 
   		$login=addslashes($_POST['login']);
   		$mdp=addslashes($_POST['mdp1']);
   		$mdp2=addslashes($_POST['mdp2']);
    	$sexe=addslashes($_POST['sexe']);
    	$role=addslashes($_POST['role']);
        if($mdp==$mdp2)
        {

            if($role=="client"){
                //on verifie s'il existe un client avec ce meme login
                $req="SELECT count(*) FROM client WHERE login = '".$login."'";
                $res=$db->query($req);
                $ligne=$res->fetch();
                $count=$ligne['count(*)'];
                if($count!=0)
                {
                    header('Location:inscription.php?erreur=1');
                   // $_Get[testlogin]=1;
                    //ce login est deja utilisé 
                  // echo"1";
                }
                else
                {
                    //sinon on l'insére dans la table client
                    $mdp=openssl_encrypt($mdp, "AES-128-ECB", "key");
                    $client=new Client($nom,$prenom,$telephone,$mail,$adresse,$login,$mdp,$sexe);
                    $result=$client->inserer_client($db);
                    if($result!=0){
                        // echo"GOOD client !! ID = $result";
                        header('Location:connexion.php?instest=1');
                    }
                    else{
                       // echo"BAD client !!"; 
                        header('Location:inscription.php?erreur=2');

                    } 
                }

            }
            else if($role=="conducteur"){
                //on verifie si le login est disponible ou pas
                $req="SELECT count(*) FROM conducteur WHERE login = '".$login."'";
                $res=$db->query($req);
                $ligne=$res->fetch();
                $count=$ligne['count(*)'];
                if($count!=0)
                {
                    // ce login est deja utilisé
                    // echo"1";
                    header('Location:inscription.php?erreur=3');
                }
                else
                {
                    // on l'insere dans la table conducteur
                    $mdp=openssl_encrypt($mdp, "AES-128-ECB", "key");
                    $conducteur=new Conducteur($nom,$prenom,$telephone,$mail,$adresse,$login,$mdp,$sexe);
                    $result=$conducteur->inserer_conducteur($db);
                    if($result!=0){
                        // echo"GOOD conducteur !! ID = $result";
                        header('Location:connexion.php?instest=2');
                    }
                    else{
                        // echo"BAD conducteur !!";
                        header('Location:inscription.php?erreur=4');
                    } 
                }
                
            }

        }
        else {
            // echo"Bad ";
            header('Location:inscription.php?erreur=5');
        } 
    }
