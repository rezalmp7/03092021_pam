<?php
    session_start();
    $thisPage = 'akun';
    
    include '../config/koneksi.php';
    $id_admin = $_SESSION['pamrh_id_admin'];
    
    $query_admin_login = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id_admin'");
    $admin_login = mysqli_fetch_assoc($query_admin_login);

    $query_data_akun = mysqli_query($koneksi, "SELECT * FROM user");

    include 'layout/header.php';
  
?>

  <div class="page-banner overlay-dark bg-image" style="background-image: url('../assets/img/gmb-4.png');">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Akun</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">AKUN</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-12 wow fadeInUp">
          <h1 class="mb-3">Akun <a href="akun_tambah.php" class="btn mt-3 btn-success float-right">Tambah</a></h1>
          
          <div class="text-lg">
            <table id="data_table" class="table table-striped table-bordered" style="width:100%">
              <thead>
                  <tr>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Level</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                  foreach ($query_data_akun as $a) {
                  ?>
                  <tr>
                      <td><?php echo $a['nama']; ?></td>
                      <td><?php echo $a['username']; ?></td>
                      <td><?php echo 'Petugas'; ?></td>
                      <td>
                        <a href="akun_edit.php?id=<?php echo $a['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-warning">Edit</a>
                        <a href="function/hapus_akun.php?id=<?php echo $a['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-danger">Hapus</a>
                      </td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php
include_once('layout/footer.php');
?>