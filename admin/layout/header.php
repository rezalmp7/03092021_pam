<?php
  if($_SESSION['pamrh_level'] != 'admin')
  {
	  $_SESSION['pamrh_flash_error'] = "Login Terlebih Dahulu";
    header('location:../login.php');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>One Health - Medical Center HTML5 Template</title>

  <link rel="stylesheet" href="../assets/assets/css/maicons.css">

  <link rel="stylesheet" href="../assets/assets/css/bootstrap.css">

  <link rel="stylesheet" href="../assets/assets/vendor/owl-carousel/css/owl.carousel.css">

  <link rel="stylesheet" href="../assets/assets/vendor/animate/animate.css">

  <link rel="stylesheet" href="../assets/assets/css/theme.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.css">

  <link rel="stylesheet" href="https://cdn.datatables.net/1.11.0/css/dataTables.bootstrap4.min.css">  

    
  <script src="../assets/assets/js/jquery-3.5.1.min.js"></script>

  <script src="../assets/assets/js/bootstrap.bundle.min.js"></script>

  <script src="../assets/assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

  <script src="../assets/assets/vendor/wow/wow.min.js"></script>

  <script src="../assets/assets/js/theme.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.4/dist/sweetalert2.min.js"></script>

  <script src="https://cdn.datatables.net/1.11.0/js/jquery.dataTables.min.js"></script>

  <script src="https://cdn.datatables.net/1.11.0/js/dataTables.bootstrap4.min.js"></script>

  <script>
    $(document).ready(function() {
      $('#data_table').DataTable();
    });
  </script>
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <div class="topbar">
      <div class="container">
        <div class="row">
          <div class="col-sm-8 text-sm">
            <div class="site-info">
              <a href="#"><span class="mai-call text-primary"></span> +00 123 4455 6666</a>
              <span class="divider">|</span>
              <a href="#"><span class="mai-mail text-primary"></span> mail@example.com</a>
            </div>
          </div>
          <div class="col-sm-4 text-right text-sm">
            <div class="social-mini-button">
              <a href="#"><span class="mai-logo-facebook-f"></span></a>
              <a href="#"><span class="mai-logo-twitter"></span></a>
              <a href="#"><span class="mai-logo-dribbble"></span></a>
              <a href="#"><span class="mai-logo-instagram"></span></a>
            </div>
          </div>
        </div> <!-- .row -->
      </div> <!-- .container -->
    </div> <!-- .topbar -->

    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="#"><span class="text-primary">PAM</span>-ROUDHOTUL HIDAYAH</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item <?php if($thisPage == 'home') echo 'active'; ?>">
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item <?php if($thisPage == 'akun') echo 'active'; ?>">
              <a class="nav-link" href="akun.php">Akun</a>
            </li>
            <li class="nav-item <?php if($thisPage == 'pelanggan') echo 'active'; ?>">
              <a class="nav-link" href="pelanggan.php">Pelanggan</a>
            </li>
            <li class="nav-item <?php if($thisPage == 'dusun') echo 'active'; ?>">
              <a class="nav-link" href="dusun.php">Kode Dusun</a>
            </li>
            <li class="nav-item">
              <div class="dropdown">
                <button class="btn btn btn-primary ml-lg-3 dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <?php echo $admin_login['nama']; ?>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <a class="dropdown-item" href="../function/logout.php">Logout</a>
                </div>
              </div>
            </li>
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>
  <?php
  if(isset($_SESSION['pamrh_flash_success']) && $_SESSION['pamrh_flash_success'] != '')
  {
  ?>
    <script type="text/javascript">
    Swal.fire({
      icon: 'success',
      title: "<?php echo $_SESSION['pamrh_flash_success']; ?>",
      showConfirmButton: false,
      timer: 1500
    })
    </script>
  <?php
  $_SESSION['pamrh_flash_success'] = '';
  }
  if(isset($_SESSION['pamrh_flash_error']) && $_SESSION['pamrh_flash_error'] != '')
  {
  ?>
  <script type="text/javascript">
    Swal.fire({
      icon: 'error',
      title: "<?php echo $_SESSION['pamrh_flash_error']; ?>",
      showConfirmButton: false,
      timer: 1500
    })
    </script>
  <?php
  $_SESSION['pamrh_flash_error'] = '';
  }
  ?>