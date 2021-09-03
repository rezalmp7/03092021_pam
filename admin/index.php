<?php
    session_start();
    $thisPage = 'home';
    
    include '../config/koneksi.php';
    $id_admin = $_SESSION['pamrh_id_admin'];
    
    $query_admin_login = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id_admin'");
    $admin_login = mysqli_fetch_assoc($query_admin_login);

    include 'layout/header.php';
  
?>

    <div class="page-hero bg-image overlay-dark" style="background-image: url(../assets/img/gmb-1.jpg);">
        <div class="hero-section">
            <div class="container text-center wow zoomIn">
                <span class="subhead">Selamat Datang <?php echo $admin_login['nama']; ?></span>
                <h1 class="display-4">PAM</h1>
                <a href="login.php" class="btn btn-primary">SCAN QR Pelanggan</a>
            </div>
        </div>
    </div>

<?php
include_once('layout/footer.php');
?>