<?php
    session_start();
    $thisPage = 'pelanggan';
    
    include '../config/koneksi.php';
    $id_admin = $_SESSION['pamrh_id_admin'];
    
    $query_admin_login = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id_admin'");
    $admin_login = mysqli_fetch_assoc($query_admin_login);

    if(isset($_GET['id']))
    {
        $id_pelanggan = $_GET['id'];
        $query_data_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id_pelanggan'");
        $data_pelanggan = mysqli_fetch_array($query_data_pelanggan);
        $id_pelanggan_tagihan = $data_pelanggan['id'];

        $query_tagihan = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE id_pelanggan = '$id_pelanggan_tagihan'");
    }

    include 'layout/header.php';
  
?>

  <div class="page-banner overlay-dark bg-image" style="background-image: url('../assets/img/gmb-4.png');">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item"><a href="pelanggan.php">Pelanggan</a></li>
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
          <h1 class="mb-3">Tagihan <a href="pelanggan_tagihan_tambah.php?id=<?php echo $data_pelanggan['id']; ?>" class="btn mt-3 btn-success float-right">Tambah</a></h1>
          
          <div class="text-lg">
            <table id="data_table" class="table table-striped table-bordered" style="width:100%">
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
                        <a target="_blank" href="pelanggan_tagihan_konfirmasi.php?id=<?php echo $data_pelanggan['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-secondary"><span class="iconify" data-icon="grommet-icons:document-verified"></span></a>
                        <a href="pelanggan_tagihan_edit.php?id=<?php echo $data_pelanggan['id']; ?>&id_tagihan=<?php echo $a['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-warning"><span class="iconify" data-icon="akar-icons:edit"></span></a>
                        <a href="function/hapus_tagihan.php?id=<?php echo $data_pelanggan['id']; ?>&id_tagihan=<?php echo $a['id']; ?>" class="btn btn-sm pt-1 pb-1 pl-3 pr-3 btn-danger"><span class="iconify" data-icon="carbon:delete"></span></a>
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