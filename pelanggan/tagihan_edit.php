<?php
    session_start();
    $thisPage = 'akun';
    
    include '../config/koneksi.php';
    $id_pelanggan = $_SESSION['pamrh_id_pelanggan'];
    
    $query_pelanggan_login = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id_pelanggan'");
    $pelanggan_login = mysqli_fetch_assoc($query_pelanggan_login);

    $id_tagihan = $_GET['id'];

    $query_data_tagihan = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE id='$id_tagihan'");
    $data_tagihan = mysqli_fetch_array($query_data_tagihan);

    
    if($data_tagihan['id_pelanggan'] != $id_pelanggan)
    {
        $_SESSION['pamrh_flash_error'] = "pembayaran dan edit harus login dengan akun sendiri";
        header('location: index.php');
    }

    if($_SESSION['pamrh_level'] != 'pelanggan')
    {
      $_SESSION['pamrh_flash_error'] = "Login Terlebih Dahulu";
      header('location:../login.php');
    }

    $query_data_dusun = mysqli_query($koneksi, "SELECT * FROM dusun");

    include 'layout/header.php';
  
?>

    <div class="page-banner overlay-dark bg-image" style="background-image: url('../assets/img/gmb-4.png');">
        <div class="banner-section">
            <div class="container text-center wow fadeInUp">
                <nav aria-label="Breadcrumb">
                    <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item"><a href="tagihan.php">Tagihan <?php echo $data_tagihan['id_tagihan']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Bayar</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Bayar Tagihan <?php echo $data_tagihan['id_tagihan']; ?></h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 wow fadeInUp">
                    <h1 class="mb-3">Bayar Tagihan</h1>
                    <div class="text-lg">
                        <form method="POST" enctype="multipart/form-data" action="function/edit_tagihan.php">
                            <input type="hidden" name="id" value="<?php echo $data_tagihan['id'];?>">
                            <input type="hidden" name="id_tagihan" value="<?php echo $data_tagihan['id_tagihan']; ?>">
                            <input type="hidden" name="gambar_lama" value="<?php echo $data_tagihan['file']; ?>">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Pengecekan</label>
                                <div class="col-12 m-0 p-0 mt-2"><?php echo date('d F Y', strtotime($data_tagihan['tgl_cek'])); ?></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meteran Awal - Akhir</label>
                                <div class="col-12 m-0 p-0 mt-2"><?php echo $data_tagihan['awal'].' - '.$data_tagihan['akhir']; ?></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pemakaian</label>
                                <div class="col-12 m-0 p-0 mt-2"><?php echo $data_tagihan['pemakaian']; ?></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Bukti Pengecekan</label><br>
                                <a class="example-image-link" href="../assets/img/meteran/<?php echo $data_tagihan['foto_meteran']; ?>" data-lightbox="example-set"><img class="example-image" style="width: 100px" src="../assets/img/meteran/<?php echo $data_tagihan['foto_meteran']; ?>" alt=""/></a>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Ganti Bukti Pembayaran</label><br>
                                <a class="example-image-link" href="../assets/img/meteran/<?php echo $data_tagihan['foto_meteran']; ?>" data-lightbox="example-set"><img class="example-image" style="width: 100px" src="../assets/img/meteran/<?php echo $data_tagihan['foto_meteran']; ?>" alt=""/></a>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="bukti_pembayaran" aria-describedby="inputGroupFileAddon01">
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                                <small class="text-danger">
                                    Ukuran file maksimal 10 MB<br>
                                    Jenis file yang diperbolehkan: .jpg .jpeg .png
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $('#inputGroupFile01').on('change', function() {
            // Ambil nama file 
            let fileName = $(this).val().split('\\').pop();
            // Ubah "Choose a file" label sesuai dengan nama file yag akan diupload
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    </script>
<?php
include_once('layout/footer.php');
?>