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
        $query_data_akun = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id_pelanggan'");
        $data_akun = mysqli_fetch_array($query_data_akun);
        $id_pelanggan_tagihan = $data_akun['id'];

        $query_tagihan = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE id_pelanggan='$id_pelanggan_tagihan'");
        $data_tagihan = mysqli_num_rows($query_tagihan);

        $query_data_akhir = mysqli_query($koneksi, "SELECT max(akhir) as max_akhir FROM tagihan WHERE id_pelanggan='$id_pelanggan_tagihan'");
        $data_akhir = mysqli_fetch_array($query_data_akhir);
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
                        <li class="breadcrumb-item"><a href="pelanggan_tagihan.php?id=<?php echo $data_akun['id']; ?>">Tagihan <?php echo $data_akun['id_pelanggan']; ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">TAMBAH TAGIHAN <?php echo $data_akun['id_pelanggan']; ?></h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 wow fadeInUp">
                    <h1 class="mb-3">Tambah Tagihan</h1>
                    <div class="text-lg">
                        <form method="POST" enctype="multipart/form-data" action="function/tambah_tagihan.php">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama Lengkap</label>
                                <input type="hidden" name="nama" value="<?php echo $data_akun['nama']; ?>">
                                <input type="text" class="form-control" value="<?php echo $data_akun['nama']; ?>" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">ID Pelanggan</label>
                                <input type="hidden" name="id_pelanggan" value="<?php echo $data_akun['id']; ?>">
                                <input type="hidden" name="id_pelanggan_pelanggan" value="<?php echo $data_akun['id_pelanggan']; ?>">
                                <input type="text" class="form-control" value="<?php echo $data_akun['id_pelanggan']; ?>" readonly required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tanggal Pengecekan</label>
                                <input type="date" class="form-control" name="tgl_cek" placeholder="Tanggal Pengecekan" required>
                            </div>
                            <?php
                            if($data_tagihan == 0)
                            {
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meteran Awal</label>
                                <input type="number" class="form-control" name="awal" placeholder="Meteran Awal" required>
                            </div>
                            <?php
                            }
                            ?>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Meteran Akhir</label>
                                <input type="hidden" name="awal" value="<?php echo $data_akhir['max_akhir']; ?>">
                                <input type="number" class="form-control" <?php if($data_tagihan != 0) echo "min='".$data_akhir['max_akhir']."'"; ?> name="akhir" placeholder="Meteran Akhir" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Unggah Bukti Pengecekan</label>
                                <div class="input-group mb-3">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="inputGroupFile01" name="bukti_cek" aria-describedby="inputGroupFileAddon01" required>
                                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                    </div>
                                </div>
                                <small class="text-danger">
                                    Ukuran file maksimal 10 MB<br>
                                    Jenis file yang diperbolehkan: .jpg .jpeg .png
                                </small>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah</button>
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