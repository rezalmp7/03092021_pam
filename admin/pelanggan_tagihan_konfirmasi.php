<?php
    session_start();
    $thisPage = 'akun';
    
    include '../config/koneksi.php';
    $id_admin = $_SESSION['pamrh_id_admin'];
    
    $query_admin_login = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$id_admin'");
    $admin_login = mysqli_fetch_assoc($query_admin_login);

    $id_pelanggan = $_GET['id'];
    $id_tagihan = $_GET['id_tagihan'];

    if(isset($_GET['id']) && isset($_GET['id_tagihan']))
    {
        $query_data_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id_pelanggan'");
        $data_pelanggan = mysqli_fetch_array($query_data_pelanggan);

        $query_data_tagihan = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE id='$id_tagihan'");
        $data_tagihan = mysqli_fetch_array($query_data_tagihan);
    }
    else {
        header("Location: pelanggan.php");
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
                        <li class="breadcrumb-item"><a href="pelanggan.php">Pelanggan</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tagihan <?php echo $data_pelanggan['id_pelanggan']; ?></li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">Bayar Tagihan <?php echo $data_tagihan['id_tagihan']; ?></h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 wow fadeInUp">
                    <h1 class="mb-3">Bayar Tagihan</h1>
                    <div class="text-lg">
                        <form method="POST" enctype="multipart/form-data" action="function/konfirmasi_tagihan.php">
                            <input type="hidden" name="id" value="<?php echo $data_tagihan['id'];?>">
                            <input type="hidden" name="id_tagihan" value="<?php echo $data_tagihan['id_tagihan']; ?>">
                            <input type="hidden" name="id_pelanggan" value="<?php echo $data_tagihan['id_pelanggan']; ?>">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Pengecekan</label>
                                <small class="col-12 d-block m-0 p-0 mt-2"><?php echo date('d F Y', strtotime($data_tagihan['tgl_cek'])); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meteran Awal - Akhir</label>
                                <small class="col-12 d-block m-0 p-0 mt-2"><?php echo $data_tagihan['awal'].' - '.$data_tagihan['akhir']; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Pemakaian</label>
                                <small class="col-12 d-block m-0 p-0 mt-2"><?php echo $data_tagihan['pemakaian']; ?></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tgl Pembayaran</label>
                                <small class="col-12 d-block m-0 p-0 mt-2"><?php echo date('d F Y', strtotime($data_tagihan['tgl_bayar'])); ?></small>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Bukti Pembayaran</label><br>
                                <a class="example-image-link" href="../assets/img/pembayaran/<?php echo $data_tagihan['file']; ?>" data-lightbox="example-set"><img class="example-image" style="width: 100px" src="../assets/img/pembayaran/<?php echo $data_tagihan['file']; ?>" alt=""/></a>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Bukti Pengecekan</label><br>
                                <a class="example-image-link" href="../assets/img/meteran/<?php echo $data_tagihan['foto_meteran']; ?>" data-lightbox="example-set"><img class="example-image" style="width: 100px" src="../assets/img/meteran/<?php echo $data_tagihan['foto_meteran']; ?>" alt=""/></a>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Metode Pembayaran</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="transfer" name="metode" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Transfer
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="petugas" name="metode" id="flexRadioDefault2">
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Ke Petugas
                                    </label>
                                </div>
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