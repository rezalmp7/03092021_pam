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
    }
    else {
        header('location: akun.php');
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
                        <li class="breadcrumb-item active" aria-current="page">Edit</li>
                    </ol>
                </nav>
                <h1 class="font-weight-normal">EDIT PELANGGAN</h1>
            </div> <!-- .container -->
        </div> <!-- .banner-section -->
    </div> <!-- .page-banner -->

    <div class="page-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8 wow fadeInUp">
                    <h1 class="mb-3">Edit Pelanggan</h1>
                    <div class="text-lg">
                        <form method="POST" action="function/edit_pelanggan.php">
                            <input type="text" name="id" value="<?php echo $data_pelanggan['id']; ?>">
                            <input type="text" name="id_pelanggan" value="<?php echo $data_pelanggan['id_pelanggan']; ?>">
                            <input type="text" name="code" value="<?php echo $data_pelanggan['code']; ?>">
                            <input type="text" name="qrcode_lama" value="<?php echo $data_pelanggan['qrcode']; ?>">
                            <input type="text" name="dusun_lama" value="<?php echo $data_pelanggan['dusun']; ?>">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nama</label>
                                <input type="text" class="form-control" name="nama" placeholder="Nama" value="<?php echo $data_pelanggan['nama']; ?>" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Dusun</label>
                                <select name="dusun" class="form-control" id="exampleFormControlSelect1" required>
                                    <option value="">-- Pilih Dusun --</option>
                                    <?php
                                    foreach ($query_data_dusun as $a) {
                                    ?>
                                    <option value="<?php echo $a['id']; ?>" <?php if($a['id'] == $data_pelanggan['dusun']) echo "selected"; ?>><?php echo $a['nama']; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-2">
                                    <label for="inputEmail4">RT</label>
                                    <input type="number" name="rt" class="form-control" placeholder="RT" value="<?php echo $data_pelanggan['rt']; ?>" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputPassword4">RW</label>
                                    <input type="number" name="rw" class="form-control" placeholder="RW" value="<?php echo $data_pelanggan['rw']; ?>" required>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="inputPassword4">No Rumah</label>
                                    <input type="number" name="noRumah" class="form-control" placeholder="No Rumah" value="<?php echo $data_pelanggan['no_rumah']; ?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Nomor HP</label>
                                <input type="number" class="form-control" name="no_hp" placeholder="Nomor Handphone" value="<?php echo $data_pelanggan['no_hp']; ?>" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Edit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
  
<?php
include_once('layout/footer.php');
?>