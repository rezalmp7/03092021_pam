
<?php
$thisPage = 'faq';
include_once('layout/header.php');
?>

  <div class="page-banner overlay-dark bg-image" style="background-image: url('./assets/img/gmb-2.png');">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">FAQ</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">FAQ</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8 wow fadeInUp">
          <h1 class="text-center mb-3">FAQ</h1>
          <div class="text-lg">
            <b>Bagaimana cara login?</b>
            <p style="margin-top: 0px; margin-bottom: 20px;">Pelanggan masuk dengan username ID Pelanggan dengan format KodedusunRTRWNorumah (contoh: BLR001122) dan kode/password yang ada di kartu.</p>
            <b>Bagaimana jika lupa password?</b>
            <p style="margin-top: 0px; margin-bottom: 20px;">Pelanggan menggunakan menu kontak kami pada halaman depan, lalu hubungi admin untuk melakukan perubahan password</p>
            <b>Siapa yang dapat mengakses datanya?</b>
            <p style="margin-top: 0px; margin-bottom: 20px;">Menjaga keamanan sistem adalah hal penting. Hanya pengguna terdaftar yang dapat mengakses (melihat dan menggunakan) data.</p>
            <b>Jenis ponsel apa yang saya perlukan?</b>
            <p style="margin-top: 0px; margin-bottom: 20px;">Ponsel apa saja dapat digunakan untuk mengakses web</p>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php
include_once('layout/footer.php');
?>