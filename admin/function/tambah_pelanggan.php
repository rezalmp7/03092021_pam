<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../../config/koneksi.php';


include('../../library/phpqrcode/qrlib.php');

// menangkap data yang dikirim dari form login

function createRandomPassword() { 

    $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
    srand((double)microtime()*1000000); 
    $i = 0; 
    $pass = '' ; 

    while ($i <= 4) { 
        $num = rand() % 33; 
        $tmp = substr($chars, $num, 1); 
        $pass = $pass . $tmp; 
        $i++; 
    } 

    return $pass; 

} 

if($_SESSION['pamrh_level'] != 'admin')
{
    $_SESSION['pamrh_flash_error'] = "Login Terlebih Dahulu";
    header('location:../login.php');
}
else {
    $nama = $_POST['nama'];
    $id_dusun = $_POST['dusun'];

    $query_data_dusun = mysqli_query($koneksi, "SELECT * FROM dusun WHERE id='$id_dusun'");
    $data_dusun = mysqli_fetch_array($query_data_dusun);

    $dusun = $data_dusun['nama'];
    $rt = $_POST['rt'];
    $rw = $_POST['rw'];
    $no_rumah = $_POST['noRumah'];
    $no_hp = $_POST['no_hp'];
    
    $query_max_id = mysqli_query($koneksi, "SELECT max(id) as maxid FROM pelanggan");
    $max_id = mysqli_fetch_array($query_max_id);
    if($max_id == null)
    {
        $id = 1;
    }
    else {
        $id = $max_id['maxid']+1;
    }

    $id_pelanggan = $data_dusun['kode'].sprintf("%06d", $id);
    $kode = createRandomPassword();


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

        mysqli_query($koneksi, "INSERT INTO pelanggan (id, id_pelanggan, nama, dusun, rt, rw, no_rumah, no_hp, level, code, qrcode) 
        VALUES ('$id', '$id_pelanggan', '$nama', '$dusun', '$rt', '$rw', '$no_rumah', '$no_hp', 'pelanggan', '$kode', '$qrcode')");

        $_SESSION['pamrh_flash_success'] = "Pelanggan Berhasil di Daftarkan dengan ID Pelanggan <b>".$id_pelanggan."</b>";
        header('location:../pelanggan.php');
    } else {
        echo 'File already generated! We can use this cached file to speed up site on common codes!';
        echo '<hr />';
        $_SESSION['pamrh_flash_success'] = "Silahkan Mencoba lagi Pendaftaran Pelanggan";
        header('location:../pelanggan_tambah.php');
    }
}

?>