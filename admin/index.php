<?php
    session_start();
    $thisPage = 'home';
    
    include '../config/koneksi.php';
    $id_admin = $_SESSION['pamrh_id_admin'];
    
    $query_admin_login = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id_admin'");
    $admin_login = mysqli_fetch_assoc($query_admin_login);

    $query_tagihan = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE status = 'butuh konfirmasi'");

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
    <div class="page-section bg-light">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Tagihan Butuh Konfirmasi</h1>
      <div class="row mt-5">
        <table id="data_table" class="table table-striped table-bordered table-responsive" style="width:100%">
              <thead>
                  <tr>
                      <th>Bulan Bayar</th>
                      <th>Tanggal Cek</th>
                      <th>ID Tagihan</th>
                      <th>Awal - Akhir</th>
                      <th>Pemakaian</th>
                      <th>Tagihan</th>
                      <th>Status</th>
                      <th>Metode</th>
                      <th>Petugas</th>
                      <th>Waktu</th>
                      <th>Foto</th>
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
                      <td class="text-capitalize"><?php echo $a['metode_bayar']; ?></td>
                      <td class="text-capitalize"><?php echo $a['petugas_verifikasi']; ?></td>
                      <td><?php echo date('H:i:s', strtotime($a['create_at'])); ?></td>
                      <td>
                        <a class="example-image-link" href="../assets/img/meteran/<?php echo $a['foto_meteran']; ?>" data-lightbox="example-set"><img class="example-image" style="width: 100px" src="../assets/img/meteran/<?php echo $a['foto_meteran']; ?>" alt=""/></a>
                      </td>
                      <td>
                        <?php
                        if($a['status'] == 'butuh konfirmasi')
                        {
                        ?>
                        <a target="_blank" href="pelanggan_tagihan_konfirmasi.php?id=<?php echo $a['id_pelanggan']; ?>&id_tagihan=<?php echo $a['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-secondary"><span class="iconify" data-icon="grommet-icons:document-verified"></span></a>
                        <?php
                        }
                        
                        if($a['status'] != 'lunas')
                        {
                        ?>
                        <a href="pelanggan_tagihan_edit.php?id=<?php echo $a['id_pelanggan']; ?>&id_tagihan=<?php echo $a['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-warning"><span class="iconify" data-icon="akar-icons:edit"></span></a>
                        <a href="function/hapus_tagihan.php?id=<?php echo $a['id_pelanggan']; ?>&id_tagihan=<?php echo $a['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-danger"><span class="iconify" data-icon="carbon:delete"></span></a>
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
    </div>
  </div> <!-- .page-section -->
<?php
include_once('layout/footer.php');
?>