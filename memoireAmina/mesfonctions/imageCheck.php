<?php
function valid_extension($file_name, $ext_ok) //pour valider ou non l'extension du fichier
{			
	$file_ext = strtolower( substr(strrchr($file_name, '.') ,1) );
	foreach($ext_ok as $k=>$ext)
		$ext_ok[$k]=strtolower($ext_ok[$k]);
	 if( in_array($file_ext, $ext_ok) ) 
		return true;
	return false;
}

function valid_size($file=null,$filesize=null) //pour valider ou non la taille du fichier
{
	$maxsize=0;
	if(isset($_POST['MAX_FILE_SIZE']))
		$maxsize=$_POST['MAX_FILE_SIZE'];
	if(!is_null($file))
	{	if($file['size'] <= $maxsize) 
			return true;
	}else
		echo "No file param";
	if(!is_null($filesize))
	{	if($filesize<= $maxsize) 
				return true;
	}else
		echo "No file size param";
	return false;
}
function move_file($sourceFile, $destPath, $destName)
{
			if(!is_dir($destPath))
				mkdir($destPath);
			//préfixer le nom du fichier par la l'instant courant
			$instantCourant=date("dmY_His",time());

			$dest = "{$destPath}/{$instantCourant}_{$destName}"; 			
			if(move_uploaded_file($sourceFile ,$dest))
					return $dest;	
			return null;
}


?>