<?php include("mabase/dbconnexion.php"); ?>
<!DOCTYPE html>

<html lang="en" class="no-js">

<head>
  <?php include("Layout/header.php"); ?>
</head>

<body>
  <!-- Header
		    ================================================== -->
  <header id="header">
    <?php include("Layout/navigation.php"); ?>
  </header>
  <?php include("Layout/design-top.php"); ?>
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
                <a href="#">
                  <img src="/memoireAmina/Content/img/about/1.jpg" alt="">
                </a>
              </div>
            </div>
          </div>
          <!-- single-well end-->
          <div class="col-md-6 col-sm-6 col-xs-12">
            <div class="well-middle">
              <div class="single-well">
                <a href="#">
                  <h4 class="sec-head">project Maintenance</h4>
                </a>
                <p>
                  Redug Lagre dolor sit amet, consectetur adipisicing elit. Itaque quas officiis iure aspernatur sit adipisci quaerat unde at nequeRedug Lagre dolor sit amet, consectetur adipisicing elit. Itaque quas officiis iure
                </p>
                <ul>
                  <li>
                    <i class="fa fa-check"></i> Interior design Package
                  </li>
                  <li>
                    <i class="fa fa-check"></i> Building House
                  </li>
                  <li>
                    <i class="fa fa-check"></i> Reparing of Residentail Roof
                  </li>
                  <li>
                    <i class="fa fa-check"></i> Renovaion of Commercial Office
                  </li>
                  <li>
                    <i class="fa fa-check"></i> Make Quality Products
                  </li>
                </ul>
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
        <div class="row">
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
              $reservation = 'reservation' . uniqid();
              $editInput = 'editInput' . uniqid();
                   echo '<div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" ontouchstart="this.classList.toggle(\'hover\');">
                      <div class="mainflip">
                        <div class="frontside">
                          <div class="card">
                          <div class="card-body text-center">
                            <p><img class=" img-fluid" src="https://sunlimetech.com/portfolio/boot4menu/assets/imgs/team/img_01.png" alt="card image"></p>
                            <h4 class="card-title">' . $NomTrajet . '</h4>
                            <p class="card-title">Date et heure: ' . $Date_Heure . '</p>
                            <p class="card-title">Nom du trajet: ' . $NomTrajet . '</p>
                            <p class="card-title">Conducteur: ' . $conducteur . '</p>
                            <p class="card-title">Voiture: ' . $voiture_bis . '</p>
                            <a  id="' . $reservation . '" class="btn btn-primary btn-sm">Réservation</a>
                            <input type="hidden" id="' . $editInput . '" name="' . $editInput . '" value="' . $id . '" />
                          </div>
                          </div>
                        </div>
                        <div class="backside">
                          <div class="card">
                            <div class="card-body text-center mt-4">
                              <h4 class="card-title">Sunlimetech</h4>
                              <p class="card-text">This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.This is basic card with image on top, title, description and button.</p>
                              <ul class="list-inline">
                                <li class="list-inline-item">
                                  <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-facebook"></i>
                                  </a>
                                </li>
                                <li class="list-inline-item">
                                  <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-twitter"></i>
                                  </a>
                                </li>
                                <li class="list-inline-item">
                                  <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-skype"></i>
                                  </a>
                                </li>
                                <li class="list-inline-item">
                                  <a class="social-icon text-xs-center" target="_blank" href="#">
                                    <i class="fa fa-google"></i>
                                  </a>
                                </li>
                              </ul>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>';
               }
           }
          ?>
          <!-- ./Team member -->
        </div>
        <!-- Team -->


      </div>
    </div><!-- End Portfolio Section -->
  </main>

  <?php include("Layout/footer.php"); ?>


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
  <!-- Template Main JS File -->
  <script src="Scripts/js/main.js"></script>

</body>

</html>