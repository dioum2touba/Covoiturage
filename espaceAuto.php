<!DOCTYPE html>
<html>
<head>
   <meta charset="utf-8" />
   <title></title>
   <link rel="stylesheet" href="css/bootstrap.min.css" >

</head>

<body>
   <div class="col-md-8">
   <form method="POST" action="traiterAuto.php" enctype="multipart/form-data">
      <h1>Espace Auto</h1>
      <input type="hidden" name="MAX_FILE_SIZE" value="5000000" /> 

      <div class="form-group">
         <label for="imm">Immatriculation</label>
         <input type="text" name="imm" class="form-control" />
   </div>
   <div class="form-group">
      <label for="type">Type</label>
      <input type="text" name="type" class="form-control" />
   </div>
   <div class="form-group">
      <label for="nbre">Nombre Place</label>
      <input type="number" name="nbre" class="form-control"/>

   </div>
   <div class="form-group">
      <label>Libelle</label>
      <input type="text" name="lib" class="form-control"/>
   </div>
   <div class="form-group">
      <input id='ims' type='file' name='ims[]' accept="image/*" multiple/><br/>
      <!-- <input id='ims' type='file' name='ims[]' accept="image/*" multiple/> -->
      
   </div>
   <p>
      <button type='submit' value='send'>Enregistrer</button>
   </p>
</form>


</body>
</html>
