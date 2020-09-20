<?php
  require("mabase/dbconnexion.php");
          $login='vadly';
          $req="SELECT count(*) FROM client WHERE login = '".$login."'";
          $res=$db->query($req);
          $ligne=$res->fetch();
          $count=$ligne['count(*)'];
          if($count!=0){
            echo"0 vadly est la";
          }
        else{
          echo "1 pas de vad";
        }

   // echo "<p>". $nb."</p>";

 ?>

<!-- 


 var nom=document.getElementByid("nom");
  var prenom=document.getElementByid("prenom");
  var telephone=document.getElementByid("telephone");
  var mail=document.getElementByid("mail");
  var adresse=document.getElementByid("adresse");
  var login=document.getElementByid("login");
  var mdp1=document.getElementByid("mdp1");
  var mdp2=document.getElementByid("mdp2");
  var sexe=document.getElementByid("sexe");
  var role=document.getElementByid("role");

  if(!nom.value){
    $message="Veuillez renseigner un nom";
  }
  if(!prenom.value){
    $message="Veuillez renseigner un prenom";
  }
  if(!telephone.value){
    $message="Veuillez renseigner un telephone";
  }
  if(!mail.value){
    $message="Veuillez renseigner un E-mail";
  }
  if(!adresse.value){
    $message="Veuillez renseigner une adresse";
  }
  if(!login.value){
    $message="Veuillez renseigner un nom d'utilisateur";
  }
  if(!mdp1.value){
    $message="Veuillez renseigner un mot de passe";
  }
  if(!mdp2.value){
    $message="Veuillez confirmer le mot de passe";
  }
  if(!sexe.value){
    $message="Veuillez renseigner un sexe M (Masculin) ou F(Féminin)";
  }
  if(!sexe.value){
    $message="Veuillez choisir entre Client et Conducteur";
  }
  // s'il y'a un message d'erreur on prends le contenu et on l' affiche dans le paragraphe qui a id message
  if(message){
    e.preventDefault();
    document;getElementByid("message").innerHTML = message;
    return false
  }
  else{
    alert("Inscription réeussie !");
  } -->