<?php
    session_start();
    require_once("mabase/dbconnexion.php"); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>PageClient</title>
       
    </head>
    <body >
        <p><b>Je suis la Page client bienvenue <?php echo $_SESSION['login']; ?></b></p>

    </body>
</html>