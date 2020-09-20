<?php
    session_start();
    require("mabase/dbconnexion.php");
 	if (isset($_POST['login']) && isset($_POST['mdp']))
 	{
   	    $login=addslashes($_POST['login']);
  	    $mdp=addslashes($_POST['mdp']);
  	    if($login!="" && $mdp!="")
  	    {
           // on verifie s'il existe dans la table client de la base un user avec ce login
  	    	$req="SELECT count(*) FROM client WHERE login = '".$login."'";
  	    	$res=$db->query($req);
  	    	$ligne=$res->fetch();
  	    	$count=$ligne['count(*)'];
  	    	if($count!=0)
  	    	{
             // si oui on recupere son id et mdp
  	    		 $res=$db->query("SELECT id,mdp FROM client WHERE login = '".$login."'");
  	    		 $ligne=$res->fetch();
  	    		 //je recupere le mdp pour le decrypter
             $pwd1=$ligne['mdp'];
             // ensuite on le decrypte 
             $pwd2=openssl_decrypt($pwd1, "AES-128-ECB", "key");
             if ($pwd2==$mdp) {
                // si le mdp saisi correspond a celui de l'utilisateur alors on lui ouvre une session
                $id=$ligne['id'];
                $_SESSION['login']=$login;
                $_SESSION['id']=$id;
                //echo "login et mdp corrects c un client $pwd2 ";
                header('Location:indexClient.php');
              }
              else{
               //echo"login ou mdp incorrect c pas un client $pwd2";
                header('Location:connexion.php?erreur=0');
              }
  	    		}
            else{
                  // on verifie s'il existe dans la table conducteur de la base un user avec ce login
                  $req="SELECT count(*) FROM conducteur WHERE login = '".$login."'";
                  $res=$db->query($req);
                  $ligne=$res->fetch();
                  $count=$ligne['count(*)'];
                  if($count!=0)
                  {
                     // si oui on recupere son id et mdp
                     $res=$db->query("SELECT id,mdp FROM conducteur WHERE login = '".$login."'");
                     $ligne=$res->fetch();
                     //je recupere le mdp pour le decrypter
                     $pwd1=$ligne['mdp'];
                     // ensuite on le decrypte 
                     $pwd2=openssl_decrypt($pwd1, "AES-128-ECB", "key");
                     if ($pwd2==$mdp) {
                      // si le mdp saisi correspond a celui de l'utilisateur alors on lui ouvre une session
                      $id=$ligne['id'];
                      $_SESSION['login']=$login;
                      $_SESSION['id']=$id;
                      // echo "login et mdp corrects c un conducteur $pwd2 ";
                      header('Location:indexConducteur.php');
                    }
                    else{
                      // echo"login ou mdp incorrect c pas un conducteur $pwd2";
                      header('Location:connexion.php?erreur=1');
                    }
                 }
                 else{
                    // ni client ni conducteur
                   header('Location:connexion.php?erreur=2');
                 }

            }
  	    		

  	    }
  	    else
  	    	header('Location:connexion.php?erreur=3');
   }
   else
   {
   	header('Location:connexion.php?erreur=4');

   }

?>