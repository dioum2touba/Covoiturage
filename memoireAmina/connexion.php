<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Connexion</title>
        <link rel="stylesheet" type="text/css" href="stylecnx.css">
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
                <p id="instest">
                    <?php
                        if(isset($_GET['instest'])){
                            $ok=$_GET['instest'];
                            if($ok==1 || $ok==2){
                                echo "inscription réussie ! vous pouvez desormais vous connectez ";
                            }
                            else
                                echo'';
                        }
                    ?>
                </p>

            <form action="traiterConnexion.php" method="POST">
                <h1>Connexion</h1>
                
                <label><b>Nom d'utilisateur</b></label>
                <input type="text" placeholder="Entrer le nom d'utilisateur" name="login" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entrer le mot de passe" name="mdp" required>

                <input type="submit" id='submit' value='LOGIN' >
                <p style="color:red; background-color: white; padding: 4px;">
                    <?php
                        if(isset($_GET['erreur'])){
                            $err=$_GET['erreur'];
                            if($err==1 || $err==0 || $err=2 || $err=3 || $err=4 ){
                                echo "Nom d'utilisateur ou mot de passe incorrect veuilez réessayer encore !";
                            }
                            else
                                echo'';
                        }
                    ?>
                </p>
            </form>
            </div>
        
    </body>
</html>