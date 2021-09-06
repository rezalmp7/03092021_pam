<?php
    session_start();
    $thisPage = 'tagihan';
    
    include '../config/koneksi.php';
    $id_pelanggan = $_SESSION['pamrh_id_pelanggan'];
    
    $query_pelanggan_login = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id_pelanggan'");
    $pelanggan_login = mysqli_fetch_assoc($query_pelanggan_login);

    $query_data_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id_pelanggan'");
    $data_pelanggan = mysqli_fetch_array($query_data_pelanggan);
    $id_pelanggan_tagihan = $data_pelanggan['id'];

    $query_tagihan = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE id_pelanggan = '$id_pelanggan_tagihan'");

    if($_SESSION['pamrh_level'] != 'pelanggan')
    {
      $_SESSION['pamrh_flash_error'] = "Login Terlebih Dahulu";
      header('location:../login.php');
    }

    include 'layout/header.php';
  
?>

  <div class="page-banner overlay-dark bg-image" style="background-image: url('../assets/img/gmb-4.png');">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Tagihan <?php echo $data_pelanggan['id_pelanggan']; ?></li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Tagian <?php echo $data_pelanggan['id_pelanggan']; ?> </h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container-fluid p-3">
      <div class="row justify-content-center">
        <div class="col-12 wow fadeInUp">
          <h1 class="mb-3">Tagihan</h1>
          
          <div class="text-lg">
            <table id="data_table" class="d-none d-md-block table table-striped table-bordered table-responsive" style="width:100%">
              <thead>
                  <tr>
                      <th>Bulan Bayar</th>
                      <th>Tanggal Cek</th>
                      <th>ID Tagihan</th>
                      <th>Awal - Akhir</th>
                      <th>Pemakaian</th>
                      <th>Tagihan</th>
                      <th>Status</th>
                      <th>Tgl Pembayaran</th>
                      <th>Bukti Pembayaran</th>
                      <th>Foto Meteran</th>
                      <th>Aksi</th>
                  </tr>
              </thead>
              <tbody>
                  <?php
                  foreach ($query_tagihan as $a) {
                  ?>
                  <tr>
                      <td><?php echo date('F Y', strtotime($a['tgl_cek'])); ?></td>
                      <td><?php echo date('d F Y', strtotime($a['tgl_cek'])); ?></td>
                      <td><?php echo $a['id_tagihan']; ?></td>
                      <td><?php echo $a['awal'].' - '.$a['akhir']; ?></td>
                      <td><?php echo $a['pemakaian']; ?></td>
                      <td><?php echo number_format($a['tagihan'],0,',','.'); ?></td>
                      <td class="text-capitalize"><?php echo $a['status']; ?></td>
                      <td><?php echo date('d F Y', strtotime($a['tgl_bayar'])); ?></td>
                      <td>
                        <?php if($a['file'] != null)
                        {
                        ?>
                        <a class="example-image-link" href="../assets/img/pembayaran/<?php echo $a['file']; ?>" data-lightbox="example-set"><img class="example-image" style="width: 100px" src="../assets/img/pembayaran/<?php echo $a['file']; ?>" alt=""/></a>
                        <?php
                        }
                        ?>
                      </td>
                      <td>
                        <a class="example-image-link" href="../assets/img/meteran/<?php echo $a['foto_meteran']; ?>" data-lightbox="example-set"><img class="example-image" style="width: 100px" src="../assets/img/meteran/<?php echo $a['foto_meteran']; ?>" alt=""/></a>
                      </td>
                      <td>
                        <?php
                        if($a['status'] == 'butuh bayar')
                        {
                        ?>
                        <a href="tagihan_bayar.php?id=<?php echo $a['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-success"><span class="iconify" data-icon="akar-icons:money"></span></a>
                        <?php
                        }
                        if($a['status'] == 'butuh konfirmasi') {
                        ?>
                        <a href="tagihan_edit.php?id=<?php echo $a['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-warning"><span class="iconify" data-icon="akar-icons:edit"></span></a>
                        <?php
                        }
                        ?>
                      </td>
                  </tr>
                  <?php
                  }
                  ?>
                </tbody>
              </table>
            </div>
            <div class="d-block d-md-none m-0 p-2">
              <?php
              foreach ($query_tagihan as $b) {
              ?>
              <div class="card text-center col-12 mt-2 mb-2 ml-0 mr-0">
                <div class="card-header">
                  <?php echo $b['id_tagihan']; ?>
                </div>
                <div class="card-body">
                  <a class="example-image-link" href="../assets/img/pembayaran/<?php echo $b['file']; ?>" data-lightbox="example-set"><img class="example-image col-5" src="../assets/img/pembayaran/<?php echo $b['file']; ?>" alt=""/></a>
                  <a class="example-image-link" href="../assets/img/meteran/<?php echo $b['foto_meteran']; ?>" data-lightbox="example-set"><img class="example-image col-5" src="../assets/img/meteran/<?php echo $b['foto_meteran']; ?>" alt=""/></a>
                  <table class="table table-sm">
                    <tbody>
                      <tr>
                        <th class="text-left" scope="row">Tagihan Bulan</th>
                        <td class="text-right"><?php echo date('F Y', strtotime($b['tgl_cek'])); ?></td>
                      </tr>
                      <tr>
                        <th class="text-left" scope="row">Meteran</th>
                        <td class="text-right"><?php echo $b['awal'].'-'.$b['akhir']; ?></td>
                      </tr>
                      <tr>
                        <th class="text-left" scope="row">Pemakaian</th>
                        <td class="text-right"><?php echo $b['pemakaian']; ?></td>
                      </tr>
                      <tr>
                        <th class="text-left" scope="row">Tagihan</th>
                        <td class="text-right"><?php echo 'Rp '.number_format($b['tagihan'],0,',','.'); ?></td>
                      </tr>
                      <tr>
                        <th class="text-left" scope="row">Status</th>
                        <td class="text-right text-capitalize"><?php echo $b['status']; ?></td>
                      </tr>
                    </tbody>
                  </table>
                  <?php
                    if($b['status'] == 'butuh bayar')
                  {
                  ?>
                  <a href="tagihan_bayar.php?id=<?php echo $a['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-success"><span class="iconify" data-icon="akar-icons:money"></span></a>
                  <?php
                  }
                  if($b['status'] == 'butuh konfirmasi') {
                  ?>
                  <a href="tagihan_edit.php?id=<?php echo $a['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-warning"><span class="iconify" data-icon="akar-icons:edit"></span></a>
                  <?php
                  }
                  ?>
                </div>
                <div class="card-footer text-muted">
                  <?php echo date('d F Y', strtotime($b['tgl_cek'])); ?>
                </div>
              </div>
              <?php
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  
<?php
include_once('layout/footer.php');
?>