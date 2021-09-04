<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../../config/koneksi.php';


include('../../library/phpqrcode/qrlib.php');

// menangkap data yang dikirim dari form login
if($_SESSION['pamrh_level'] != 'admin')
{
    $_SESSION['pamrh_flash_error'] = "Login Terlebih Dahulu";
    // header('location:../login.php');
}
else {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $id_dusun = $_POST['dusun'];

    $query_data_dusun = mysqli_query($koneksi, "SELECT * FROM dusun WHERE id='$id_dusun'");
    $data_dusun = mysqli_fetch_array($query_data_dusun);

    $dusun_lama = $_POST['dusun_lama'];
    $dusun = $id_dusun;
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $no_rumah = $_POST['noRumah'];
    $no_hp = $_POST['no_hp'];
    $kode = $_POST['code'];
    $id_pelanggan = $data_dusun['kode'].sprintf("%06d", $id);
    $qrcode_lama = $_POST['qrcode_lama'];
    unlink("../../assets/img/qrcode/".$qrcode_lama);
    
    // how to save PNG codes to server
    
    $tempDir = '../../assets/img/qrcode/';
    
    $codeContents = $id_pelanggan;
    
    // we need to generate filename somehow, 
    // with md5 or with database ID used to obtains $codeContents...
    $fileName = 'qrcode_'.$id_pelanggan.'_'.md5($codeContents).'.png';
    
    $pngAbsoluteFilePath = $tempDir.$fileName;
    $urlRelativeFilePath = $tempDir.$fileName;
    
    // generating
    if (!file_exists($pngAbsoluteFilePath)) {
        QRcode::png($codeContents, $pngAbsoluteFilePath);
        echo 'File generated!';
        echo '<hr />';

        $qrcode = $fileName;

        mysqli_query($koneksi, "UPDATE pelanggan SET id_pelanggan='$id_pelanggan', nama='$nama', dusun='$dusun', rt='$rt', rw='$rw', no_rumah='$no_rumah', no_hp='$no_hp', level='pelanggan', code='$kode', qrcode='$qrcode' WHERE id='$id'");

        $_SESSION['pamrh_flash_success'] = "Pelanggan Berhasil di Update silahkan cetak ulang kartu <b>".$id_pelanggan."</b>";
        header('location:../pelanggan.php');
    } else {
        echo 'File already generated! We can use this cached file to speed up site on common codes!';
        echo '<hr />';
        $_SESSION['pamrh_flash_success'] = "Silahkan Mencoba lagi Pendaftaran Pelanggan";
        header('location:../pelanggan_tambah.php');
    }
}

?>