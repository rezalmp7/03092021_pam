<?php
    session_start();
    $thisPage = 'dusun';
    
    include '../config/koneksi.php';
    $id_admin = $_SESSION['pamrh_id_admin'];
    
    $query_admin_login = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id_admin'");
    $admin_login = mysqli_fetch_assoc($query_admin_login);

    $query_data_akun = mysqli_query($koneksi, "SELECT * FROM user");
    $data_akun = mysqli_fetch_array($query_admin_login);
    print_r($data_akun);

    include 'layout/header.php';
  
?>

    <div class="page-banner overlay-dark bg-image" style="background-image: url('../assets/img/gmb-4.png');">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="dusun.php">Dusun</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">TAMBAH DUSUN</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 wow fadeInUp">
                    <h1 class="mb-3">Tambah Dusun</h1>
                    <div class="text-lg">
                        <form method="POST" action="function/tambah_dusun.php">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Dusun</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama" maxlength="50">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Kode Dusun <small class="text-danger">Kode terdiri dari 3 Huruf</small></label>
                                <input type="text" class="form-control" name="kode" placeholder="Kode" maxlength="3">
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
<?php
include_once('layout/footer.php');
?>