<?php include("../mabase/dbconnexion.php"); ?>
<!DOCTYPE html>

<html lang="en" class="no-js">

<head>
	<?php include("../Layout/header.php"); ?>
</head>

<body>
	<!-- Header
		    ================================================== -->
	<header id="header">
		<?php include("../Layout/navigation.php"); ?>
	</header>
	<?php include("../Layout/design-top.php"); ?>
	<main id="main">
		<!-- ======= About Section ======= -->
		<div id="about" class="about-area area-padding">
			<div class="container">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
							<h2>About eBusiness</h2>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single-well start-->
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="well-left">
							<div class="single-well">
								<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Ajouter une offre</button>
							</div>
						</div>
					</div>
					<!-- single-well end-->
					<div class="col-md-6 col-sm-6 col-xs-12">
						<div class="well-middle">
							<div class="single-well">
								<form class="search-course">
									<input type="search" name="search" id="search_course" placeholder="Search Courses..." />
									<button type="submit">
										<i class="material-icons">search</i>
									</button>
								</form>
							</div>
						</div>
					</div>
					<!-- End col-->
				</div>
			</div>
		</div><!-- End About Section -->

		<!-- ======= Portfolio Section ======= -->
		<div id="portfolio" class="portfolio-area area-padding fix">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="section-headline text-center">
							<h2>Nos offres</h2>
						</div>
					</div>
				</div>

				<!-- Team member -->
				<?php
				$sth = $db->prepare("Select * from offre");
				$sth->execute();
				$i = 0;
				if ($sth->rowCount()) {
					while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
						$i++;
						// recupération des données lier à l'offre
						$id = $row['Id'];
						$Date_Heure = $row['Date_Heure'];
						$NomTrajet = $row['NomTrajet'];
						$NombrePlace = $row['NombrePlace'];
						$ConducteurId = $row['ConducteurId'];
						$VoitureId = $row['VoitureId'];

						// Recupération du conducteur
						$conduct = $db->prepare("Select * from conducteur where id = $ConducteurId");
						$conduct->execute();
						$row_conduct = $conduct->fetch(PDO::FETCH_ASSOC);
						$conducteur = $row_conduct['nom'] . ' ' . $row_conduct['prenom'];

						// Recupération de la voiture
						$voiture = $db->prepare("Select * from voiture where imm = '$VoitureId'");
						$voiture->execute();
						$row_voiture = $voiture->fetch(PDO::FETCH_ASSOC);
						$voiture_bis = $row_voiture['type'] . ' ' . $row_voiture['libelle'];
						if ($i == 1) {
							echo '<div class="row">';
						}
						$editOffre = 'editOffre' . uniqid();
						$deleteOffre = 'deleteOffre' . uniqid();
						$editInput = 'editInput' . uniqid();
						echo '<div class="col-xs-12 col-sm-6 col-md-4">
									<div class="image-flip"">
										<div class="mainflip">
											<div>
												<div class="card">
													<div class="card-body text-center">
														<p><img class=" img-fluid" src="https://sunlimetech.com/portfolio/boot4menu/assets/imgs/team/img_01.png" alt="card image"></p>
														<h4 class="card-title">' . $NomTrajet . '</h4>
														<p class="card-title">Date et heure: ' . $Date_Heure . '</p>
														<p class="card-title">Nom du trajet: ' . $NomTrajet . '</p>
														<p class="card-title">Conducteur: ' . $conducteur . '</p>
														<p class="card-title">Voiture: ' . $voiture_bis . '</p>
														<a  id="' . $editOffre . '" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
														<input type="hidden" id="' . $editInput . '" name="' . $editInput . '" value="' . $id . '" />
														<a id="' . $deleteOffre . '" href="#" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								
								<script src="/memoireAmina/Content/vendor/jquery/jquery.min.js"></script>
								<script>
								$(document).ready(function() {
									$("#' . $deleteOffre . '").click(function() {
										$.confirm({
											title: \'Confirm!\',
											content: \'Êtes-vous de vouloir le supprimer!\',
											buttons: {
												confirm: function () {
													axios.post(\'http://localhost/memoireAmina/api/offre/delete.php\', {
														id: '.$id.'
													})
													.then(function(response) {
														console.log(response);
														$.alert(\'Supprimé avec succés!\');
														window.location.reload(true);
													})
													.catch(function(error) {
														console.log(error);
													});
												},
												cancel: function () {
													$.alert(\'Annulé!\');
												}
											}
										});
															   
										
									})

									$("#' . $editOffre . '").click(function() {
										var value= $("#' . $editInput . '").val();
										$(\'#exampleModalEdit\').modal(\'show\');
										console.log("Response select: Debut")
										$.ajax({
											type: "Get",
											dataType: "JSON",
											url: ("http://localhost/memoireAmina/api/offre/read_one.php?id=' . $id . '"),
											success: function(response) {
												console.log("Response select succes: ")
												console.log(response);
												$(\'#idEdit\').val(response.id);
												$(\'#NomTrajetEdit\').val(response.nomTrajet);
												$(\'#Date_HeureEdit\').val(response.date_heure);
												$(\'#NombrePlaceEdit\').val(response.nombrePlace);
												$("div.id_100 select").val(response.voitureid);
											},
											error: function(response) {
												console.log("Response select error: ")
												console.log(response);
											}
										})
									})
								});
								</script>';
						if ($i == 3) {
							echo '</div><br /><br />';
							$i = 0;
						}
					}
				}
				?>
				<!-- ./Team member -->

				<!-- Team -->


			</div>
		</div><!-- End Portfolio Section -->
	</main>

	<section class="page-banner-section">
		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document" style="margin-top: 210px;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLabel">Nouvelle offre<age</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="NomTrajet" class="col-form-label">Nom du trajet:</label>
								<input type="text" class="form-control" id="NomTrajet" name="NomTrajet">
							</div>
							<div class="form-group">
								<label for="Date_Heure" class="col-form-label"> Date et Heure:</label>
								<input type="datetime" class="form-control" id="Date_Heure" name="Date_Heure" value="<?php echo date('d/m/Y H:i:s'); ?>" />
							</div>
							<div class="form-group">
								<label for="Voiture" class="col-form-label">Voiture:</label>
								<?php
								$sth = $db->prepare("Select * from voiture");
								$sth->execute();

								if ($sth->rowCount()) {
									echo "<select class=\"form-control\" id='Voiture'  name='Voiture'>";
									echo "<option value='0'>Sélectionner</option>";
									while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
										echo "<option value='" . $row['imm'] . "'>" . $row['type'] . "</option>";
									}
									echo "</select>";
								}
								?>
							</div>
							<div class="form-group">
								<label for="NombrePlace" class="col-form-label">Nombre de place:</label>
								<input type="text" class="form-control" id="NombrePlace" readonly name="NombrePlace">
								<input type="hidden" class="form-control" id="conducteurId" readonly name="conducteurId">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="saveData" class="btn btn-primary">Enregistrer</button>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="page-banner-section">
		<div class="modal fade" id="exampleModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalEditLabel" aria-hidden="true">
			<div class="modal-dialog" role="document" style="margin-top: 210px;">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalEditLabel">Modifier offre<age</h5> <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group">
								<label for="NomTrajetEdit" class="col-form-label">Nom du trajet:</label>
								<input type="text" class="form-control" id="NomTrajetEdit" name="NomTrajetEdit">
								<input type="hidden" class="form-control" id="idEdit" name="idEdit">
							</div>
							<div class="form-group">
								<label for="Date_HeureEdit" class="col-form-label"> Date et Heure:</label>
								<input type="datetime" class="form-control" id="Date_HeureEdit" name="Date_HeureEdit" value="<?php echo date('d/m/Y H:i:s'); ?>" />
							</div>
							<div class="form-group id_100">
								<label for="VoitureEdit" class="col-form-label">Voiture:</label>
								<?php
								$sth = $db->prepare("Select * from voiture");
								$sth->execute();

								if ($sth->rowCount()) {
									echo "<select class=\"form-control\" id='VoitureEdit'  name='VoitureEdit'>";
									echo "<option value='0'>Sélectionner</option>";
									while ($row = $sth->fetch(PDO::FETCH_ASSOC)) {
										echo "<option value='" . $row['imm'] . "'>" . $row['type'] . "</option>";
									}
									echo "</select>";
								}
								?>
							</div>
							<div class="form-group">
								<label for="NombrePlace" class="col-form-label">Nombre de place:</label>
								<input type="text" class="form-control" id="NombrePlaceEdit" readonly name="NombrePlaceEdit">
								<input type="hidden" class="form-control" id="conducteurIdEdit" readonly name="conducteurIdEdit">
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="button" id="saveDataEdit" class="btn btn-primary">Enregistrer</button>
					</div>
				</div>
			</div>
		</div>
	</section>


	<?php include("../Layout/footer.php"); ?>


	<!-- Vendor JS Files -->
	<script src="/memoireAmina/Content/vendor/jquery/jquery.min.js"></script>
	<script src="/memoireAmina/Content/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="/memoireAmina/Content/vendor/jquery.easing/jquery.easing.min.js"></script>
	<script src="/memoireAmina/Content/vendor/php-email-form/validate.js"></script>
	<script src="/memoireAmina/Content/vendor/appear/jquery.appear.js"></script>
	<script src="/memoireAmina/Content/vendor/knob/jquery.knob.js"></script>
	<script src="/memoireAmina/Content/vendor/parallax/parallax.js"></script>
	<script src="/memoireAmina/Content/vendor/wow/wow.min.js"></script>
	<script src="/memoireAmina/Content/vendor/isotope-layout/isotope.pkgd.min.js"></script>
	<script src="/memoireAmina/Content/vendor/nivo-slider/js/jquery.nivo.slider.js"></script>
	<script src="/memoireAmina/Content/vendor/owl.carousel/owl.carousel.min.js"></script>
	<script src="/memoireAmina/Content/vendor/venobox/venobox.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
	<!-- Template Main JS File -->
	<script src="../Scripts/js/main.js"></script>
	<script>
		$(document).ready(function() {
			$("#addOffre").click(function() {
				alert('button clicked');
			});

			$("#saveData").click(function() {
				axios.post('http://localhost/memoireAmina/api/offre/create.php', {
						nomTrajet: $('#NomTrajet').val(),
						date_heure: $('#Date_Heure').val(),
						nombrePlace: $('#NombrePlace').val(),
						voitureid: $('#Voiture').val(),
						conducteurId: $('#conducteurId').val()
					})
					.then(function(response) {
						console.log(response);
						$('#exampleModal').modal('hide');
						window.location.reload(true);
					})
					.catch(function(error) {
						console.log(error);
					});
			});

			$("#saveDataEdit").click(function() {
				axios.post('http://localhost/memoireAmina/api/offre/update.php ', {
						id: $('#idEdit').val(),
						nomTrajet: $('#NomTrajetEdit').val(),
						date_heure: $('#Date_HeureEdit').val(),
						nombrePlace: $('#NombrePlaceEdit').val(),
						voitureid: $('#VoitureEdit').val(),
						conducteurId: $('#conducteurIdEdit').val()
					})
					.then(function(response) {
						console.log(response);
						$('#exampleModal').modal('hide');
						window.location.reload(true);
					})
					.catch(function(error) {
						console.log(error);
					});
			});

			$("#Voiture").on('change', function() {
				console.log("Response select: Debut")
				$.ajax({
					type: "Get",
					dataType: "JSON",
					url: 'http://localhost/memoireAmina/api/offre/getVoitureById.php?imm=' + this.value,
					success: function(response) {
						console.log("Response select succes: ")
						console.log(response);
						$('#NombrePlace').val(response.nbrPlace);
						$('#conducteurId').val(response.conducteurkey);
					},
					error: function(response) {
						console.log("Response select error: ")
						console.log(response);
					}
				})
			})

			$("#VoitureEdit").on('change', function() {
				console.log("Response select: Debut")
				$.ajax({
					type: "Get",
					dataType: "JSON",
					url: 'http://localhost/memoireAmina/api/offre/getVoitureById.php?imm=' + this.value,
					success: function(response) {
						console.log("Response select succes: ")
						console.log(response);
						$('#NombrePlaceEdit').val(response.nbrPlace);
						$('#conducteurIdEdit').val(response.conducteurkey);
					},
					error: function(response) {
						console.log("Response select error: ")
						console.log(response);
					}
				})
			})


		});
	</script>
</body>

</html>