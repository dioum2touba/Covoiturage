<?php

	require("mabase/dbconnexion.php");
	spl_autoload_register( function ($class) {
    include("./mesclasses/".$class.'.class.php');
    } );
   //On verifie que le formulaire a ete envoye
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
        //On verifie si le mot de passe et celui de la verification sont identiques
    	if($mdp==$mdp2)
    	{

      	   // $mdp=openssl_encrypt($mdp, "AES-128-ECB", "key");
            //On verifie si le mot de passe a 6 caracteres ou plus
            if((strlen($mdp)>=6) && (strlen($mdp)<=10)){
                 //On verifie si lemail est valide
                if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$mail)){
                    if($role="client"){
                        //On verifie sil ny a pas deja un utilisateur inscrit avec le pseudo choisis
                        $sql='select count(*) from client where login="'.$login.'"';
                        $req=$db->query($sql);
                        $result=$req->fetch();
                        $dn=$result['count(*)'];
                        if($dn==0){
                             //On enregistre les informations dans la table client de la base de donnee 
                             $client=new Client($nom,$prenom,$telephone,$mail,$adresse,$login,$mdp,$sexe);
                             $res=$client->inserer_client($db);
                             if($res!=0){echo"GOOD client !! ID = $res";}
                             else echo"BAD client !!";
                         }
                        else{
                            //Sinon, on dit que le login voulu est deja pris
                            echo'Un autre utilisateur utilise a déja le nom d\'utilisateur que vous désirez utiliser.';
                         }
                    }
                    else if($role=="conducteur"){
                        //On verifie sil ny a pas deja un utilisateur inscrit avec le pseudo choisis
                        $dn = mysql_num_rows(mysql_query('select id from conducteur where username="'.$login.'"'));
                        if($dn==0){
                            //On enregistre les informations dans la table conducteur de la base de donnee
                            $conducteur=new Conducteur($nom,$prenom,$telephone,$mail,$adresse,$login,$mdp,$sexe);
                            $result=$conducteur->inserer_conducteur($db);
                            if($result!=0){echo"GOOD conducteur !! ID = $result";}
                            else echo"BAD conducteur !!"; 
                        }
                        else{
                            //Sinon, on dit que le login voulu est deja pris
                         echo'Un autre utilisateur utilise a déja le nom d\'utilisateur que vous désirez utiliser.';
                        }
                    }
                }
                else{
                    //Sinon, on dit que lemail nest pas valide
                    echo'L\'email que vous avez entr&eacute; n\'est pas valide.';
                }	
            }
            else{
                //Sinon, on dit que le mot de passe nest pas assez long
                echo'Le mot de passe que vous avez entr&eacute; contien moins de 6 caract&egrave;res.';
            }
        }
        else{
            //Sinon, on dit que les mots de passes ne sont pas identiques
           echo'Les mots de passe que vous avez entr&eacute; ne sont pas identiques.';
        }
    	
    }

?>
