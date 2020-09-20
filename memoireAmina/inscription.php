<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Inscription</title>
        <link rel="stylesheet" type="text/css" href="styleins.css">

<!--         <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
        <script>
            var b= function(){
                alert("toto");
            };
        </script> -->
	</head>
	<body>
        <div id="entete">
            <div id="trucs">
                <b class="options">FAQ</b>
                <b class="options">Proposer un trajet</b>
                <a href="inscription.php"><b class="options">Inscription</b></a>
                <a href="connexion.php"><b class="options">Connexion</b></a>                
            </div>
            <a href="pageMain.php"><img class="image_entete" src="image/imagebg.JPG" /></a>
            <a href="pageMain.php"><p class="nomsite"> Sunu Trajet</p></a>
        </div>
		<div id="contenu">
                <p id="erreur">
                    <?php
                        if(isset($_GET['erreur'])){
                            $err=$_GET['erreur'];
                            if($err==1 || $err==3 || $err==2 || $err==4 || $err=5){
                                echo "Une erreur est survenue lors de l'inscription , veuillez réessayer ultérieurement ! ";
                            }
                            else
                                echo'';
                        }
                    ?>
                </p>
		    <form id="inscription" name="inscription" action="traiterInscription.php" method="POST">
                <h1>Inscription</h1>
                
                <label><b>Nom</b></label>
                <input type="text" placeholder="Entrer votre nom" name="nom" required>
                 <label><b>Prénom</b></label>
                <input type="text" placeholder="Entrer votre prénom" name="prenom" required>
                 <label><b>Téléphone</b></label>
                <input type="tel" placeholder="Entrer votre numéro de telephone" name="telephone" required>
                <label><b>E-mail</b></label>
                <input type="email" placeholder="Entrer votre email" name="mail" pattern="[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z.]{2,4}$" required>                
                 <label><b>Adresse</b></label>
                <input type="text" placeholder="Où habitez-vous?" name="adresse" required>
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer un nom d'utilisateur" name="login" id="login" required>
                <!-- champs pour afficher ce login existe deja -->
                <p style="color:red;" id="loginjs">
                    <?php
                        if(isset($_GET['erreur'])){
                            $err=$_GET['erreur'];
                            if($err==1){
                                echo "ce login est deja utilisé veuillez choisir un autre";
                            }
                            else
                                echo'';
                        }
                    ?>
                </p>
                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdp1" id="mdp1" required>
                <p id="pwdjs" style="color: red;"></p>
                <label><b>Confirmer le mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdp2" id="mdp2" required>
                <p>
                <p id="mdpjs" style="color: red;"></p>
                  <label><b> Sexe : </b></label>
                  <span class="check">M</span>
                  <input type="radio" name="sexe" value="M"/>
                  <span class="check">F</span>
                  <input type="radio" name="sexe" value="F"/>
                </p>
                <p>
                  <label><b> Etes-vous ? : </b></label>
                  <span class="check">Conducteur </span>
                  <input type="radio" name="role" value="conducteur"/>
                  <span class="check">ou Client</span>
                  <input type="radio" name="role" value="client"/>
                </p>

                <input type="submit" id='submit' value="S'incrire" >
            </form>
            <p style="color:red;" id="erreur"></p>
		</div>
        <!-- <p style="color:red;" id="erreur"></p> -->
        <script type="text/javascript" src="./page.js"></script>
	</body>
</html>		