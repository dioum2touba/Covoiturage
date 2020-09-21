<?php
  session_start();
  require("mabase/dbconnexion.php");
  require("mesfonctions/imageCheck.php");

if(isset($_POST['imm']) && isset($_POST['type']) && isset($_POST['nbre']) && isset($_POST['lib']))
{
    $conducteur=$_SESSION['id'];
    $imm=$_POST['imm'];
    $type=$_POST['type'];
    $nbre=$_POST['nbre'];
    $lib=$_POST['lib'];
    $imm=addslashes($imm);
    $type=addslashes($type);
    $nbre=addslashes($nbre);
    $lib=addslashes($lib);
   
    if(isset($_FILES['ims']))
    {
      $nfs=count($_FILES['ims']['name']);
      $files=$_FILES['ims'];
      for($i=0;$i<$nfs;$i++)
      {
        if($files['error'][$i]==0)
        {
          echo("<br/><br/>Image n° ".($i+1)." :<br/>");
          echo "<br/>UPLOAD réussi<br/>";
          echo "<br/>Nom du fichier origine : ".$files['name'][$i]."<br/>";
          echo "<br/>Taille du fichier : ".$files['size'][$i]."<br/>";
          $file_name=$files['name'][$i];
          $ext_bonne=array('png','jpeg','jpg');
          if(valid_extension($file_name,$ext_bonne))
          {
            echo "<br/>Extension est bien valide<br/>";
            if(valid_size($file=null,$filesize=$files['size'][$i]))
            {
              echo "<br/>La taille est bien valide<br/>";
              if($imc=move_file($files['tmp_name'][$i],"NouvelleDestination",$file_name))
                {

                  $req="insert into voiture values('$imm','$type',$nbre,'$lib',$conducteur) ";
                  echo "<br/>";
                  echo $req;
                  $imc=addslashes($imc);
                  $reqIms="insert into image values(NULL,'$imc','$imm')"; 
                  
                  $db->beginTransaction();

                  $res=$db->exec($req);

                  // on va utiliser une session de l id du conducteur $immauto=$db->lastInsertId();

                  $resim=$db->exec($reqIms);

                  $db->commit();
                   // $db->rollback();
                  if($res){
                    if($resim){
                      // succes 
                    echo "<br/>ajout avec succès avec comme id : <br/>";
                    echo("<br/>Image n° ".($i+1)." sauvegardée avec succès :<br/>");
                    }
                  }
                  else
                    echo "<br/>echec de l'ajout<br/>";

                  }

                }

              else
                echo "problème lors du déplacement";
                

            }
            else
              echo "<br/>La taille pas valide <br/>";

          }
          else
            echo "<br/>Extension pas valide<br/>";


        }
      }


 //  echo"info voiture ok";


	// echo "Immatriculation:";
	// echo" ";
 //    echo $_POST['imm'];
 //    echo "<br/>";
	//    echo "Type:";
	//    echo" ";
	//    echo $_POST['type'];
	// echo "<br/>";
	// echo "Nombre de Place:";
	// echo" ";
 //   echo $_POST['nbre'];
 //   echo "<br/>";
 //   echo "Libelle";
 //   echo" ";
 //   echo $_POST['lib'];
 //   echo "<br/>";


}
// if(isset($_FILES['ims']))
//     {

//       echo"image existe";


//       $nfs=count($_FILES['ims']['name']);
//       $files=$_FILES['ims'];
//       for($i=0;$i<$nfs;$i++)
//       {
//         if($files['error'][$i]==0)
//         {
//           echo("<br/><br/>Image n° ".($i+1)." :<br/>");
//           echo "<br/>UPLOAD réussi<br/>";
//           echo "<br/>Nom du fichier origine : ".$files['name'][$i]."<br/>";
//           echo "<br/>Taille du fichier : ".$files['size'][$i]."<br/>";
//           $file_name=$files['name'][$i];
//           $ext_bonne=array('png','jpeg','jpg');
//           if(valid_extension($file_name,$ext_bonne))
//           {
//             echo "<br/>Extension est bien valide<br/>";
//             if(valid_size($file=null,$filesize=$files['size'][$i]))
//             {
//               echo "<br/>La taille est bien valide<br/>";
//               if($imc=move_file($files['tmp_name'][$i],"NouvelleDestination",$file_name))
//                 {
//                   $imc=addslashes($imc);
//                   $reqIms="insert into image values('$imc',$id)"; 
//                   $resim=$db->exec($reqIms);
//                   if($resim)
//                     echo("<br/>Image n° ".($i+1)." sauvegardée avec succès :<br/>");

//                 }

//               else
//                 echo "problème lors du déplacement";
                

//             }
//             else
//               echo "<br/>La taille pas valide <br/>";

//           }
//           else
//             echo "<br/>Extension pas valide<br/>";


//         }
//       }
//     }

//     $imm=addslashes($imm);
//     $type=addslashes($type);
//     $np=addslashes($nbre_place);
//     $ims=addslashes($ims);

// $req="insert into voiture values('$imm','$type','$nbre_place','$Libelle') ";
    
    
//      // $db->beginTransaction();

//       $res=$db->exec($req);

//       $imm=$db->lastInsertId();

//      // $db->commit();
//      // $db->rollback();
//     if($res)
//       echo "<br/>ajout avec succès avec comme id : $idProd <br/>";
//     else
//       echo "<br/>echec de l'ajout<br/>";
?>