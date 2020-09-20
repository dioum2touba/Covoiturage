<?php
	// require("functions/fileFunctions.php");
	// require("db/dbconn.php");

	if(isset($_POST['nom']) &&
		isset($_POST['cat']) &&
		isset($_POST['qte']) &&
		isset($_POST['pu']) &&
		isset($_POST['des']))
	{
		$nom=$_POST['nom'];
		$cat=$_POST['cat'];
		$qte=$_POST['qte'];
		$pu=$_POST['pu'];
		$des=$_POST['des'];
		$im=null;
		if(isset($_FILES['im']))
		{
			$imfile=$_FILES['im'];
			if($imfile['error']==0)
			{
				$file_name=$imfile['name'];
				$exts_bonne=array('png','jpeg','jpg');
				if(valid_extension($file_name,$exts_bonne))
				{
					echo "<br/>Extension est bien valide<br/><br/>";
					if(valid_size($file=$imfile,$filesize=null))
					{
						echo "<br/>La taille est bien valide<br/><br/>";
						if($im=move_file($imfile['tmp_name'],"NouvelleDestination",$file_name))
							echo "Image sauvegardée avec succès : $im";

						else
							echo "problème lors du déplacement";
							

					}
					else
						echo "<br/>La taille pas valide<br/><br/>";



				}
				else
					echo "<br/>Extension pas valide<br/><br/>";

			}

		}

		$nom=addslashes($nom);
		$cat=addslashes($cat);
		$des=addslashes($des);
		$im=addslashes($im);
		
		$req="insert into produit values(NULL,'$nom','$cat',$qte,$pu,'$des','$im') ";
		echo "<br/>";
		echo $req;
		
		 $db->beginTransaction();

		 	$res=$db->exec($req);

			$idProd=$db->lastInsertId();

		 $db->commit();
		 $db->rollback();
		if($res)
			echo "<br/>ajout avec succès avec comme id : $idProd <br/>";
		else
			echo "<br/>echec de l'ajout<br/>";




		echo "<br/><br/><br/><br/>TRAITEMENTS DES autres images";
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
									$imc=addslashes($imc);
									$reqIms="insert into images values(NULL,'$imc',$idProd)"; 
									$resim=$db->exec($reqIms);
									if($resim)
										echo("<br/>Image n° ".($i+1)." sauvegardée avec succès :<br/>");

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
		}









	}







	




?>