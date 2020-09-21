<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Formulaire de saisie de produit</title>
		<style type="text/css">
			div
			{
				border:1px solid blue;
				border-radius: 5px 20px;
				width:90%;
				margin:auto;
				min-height: 700px;
			}
			div h1,form
			{
				width:60%;
				margin:auto;

			}
			div h1
			{
				text-align: center
				color:blue;
				font-family: 'Trebuchet MS';
			}
			#myForm
			{
				padding: 5%;
				padding-left: 20%;
				background: silver;
				border-radius: 5px 20px;


			}
			label
			{
				display: inline-block;
				width: 30%;
				color: darkblue;
				font-size: 130%;
				font-weight: bold;
			}
			input,select,textarea
			{
				
				display: inline-block;
				width: 40%;
				font-size: 130%;
			}



		</style>
	</head>
	<body>
		<div>
			<h1>Enregistrement d'un nouveau produit </h1>
			<form id= 'myForm' action='traiterajout.php'  method='POST'
			enctype='multipart/form-data'>
			
				<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
				<p>
					<label for='nom'> Désignation : </label>
					<input type="text" name="nom">
				
				</p>
				<p>
					<label for='cat'> Catégorie : </label>
					<select name='cat'>
						<option value="vetements"> Vêtements</option>
						<option value="chaussures"> Chaussures</option>
						<option value="montres"> Montres</option>
					</select>
				</p>
				<p>
					<label for='qte'> Quantité  : </label>
					<input type="number" name="qte" min='0'>
				</p>
				<p>
					<label for='pu'> Prix unitaire : </label>
					<input type="number" min='500' step='500' name="pu">
				</p>
				<p>
					<label for='des'> Description : </label>
					<textarea name='des' rows='5' placeholder="Description du produit"></textarea>

				</p>
				<p>
					<label for='im'> Image : </label>
					<input id='im' type='file' name='im' accept="image/*"/><br/>
				</p>
				<p>
					<label for='ims'> Autres images: </label>
					<input id='ims' type='file' name='ims[]' accept="image/*" multiple/><br/>
				</p>
				<p>
					<button type='submit' value='send'>Enregistrer</button>

				</p>
			</form>
		</div>

	</body>	

</html>		

