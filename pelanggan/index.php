<?php
    session_start();
    $thisPage = 'home';
    
    include '../config/koneksi.php';
    $id_login = $_SESSION['pamrh_id_pelanggan'];
    
    $query_pelanggan_login = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id_login'");
    $pelanggan_login = mysqli_fetch_assoc($query_pelanggan_login);

    if($_SESSION['pamrh_level'] != 'pelanggan')
    {
      $_SESSION['pamrh_flash_error'] = "Login Terlebih Dahulu";
      header('location:../login.php');
    }

    include 'layout/header.php';
  
?>

  <div class="page-hero bg-image overlay-dark" style="background-image: url('../assets/img/gmb-1.jpg');">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        <span class="subhead">Air Bersih Untuk Masyarakat</span>
        <h1 class="display-4">PAM</h1>
        <a href="scan.php" class="btn btn-primary">SCAN QR</a>
      </div>
    </div>
  </div>

  <!-- <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp text-capitalize">Masukan Pesan Anda</h1>

      <form class="main-form">
        <div class="row mt-5 ">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
            <input type="text" class="form-control" placeholder="Full name">
          </div>
          <div class="col-12 col-sm-6 py-2 wow fadeInRight">
            <input type="text" class="form-control" placeholder="Email address..">
          </div>
          <div class="col-12 py-2 wow fadeInUp" data-wow-delay="300ms">
            <textarea name="message" id="message" class="form-control" rows="6" placeholder="Enter message.."></textarea>
          </div>
        </div>

        <button type="submit" class="btn btn-primary mt-3 wow zoomIn">Kirim</button>
      </form>
    </div>
  </div>  -->
  <!-- .page-section -->
<?php
include_once('layout/footer.php');
?>