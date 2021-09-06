<?php
  $thisPage = 'home';
  include './layout/header.php';
?>

  <div class="page-hero bg-image overlay-dark" style="background-image: url(./assets/img/gmb-1.jpg);">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        <span class="subhead">Untuk lihat tagihan</span>
        <h1 class="display-4">PAM</h1>
        <a href="pelanggan/scan.php" class="btn btn-primary">SCAN QR</a>
      </div>
    </div>
  </div>

<?php
include_once('layout/footer.php');
?>