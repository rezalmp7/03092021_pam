<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../../config/koneksi.php';

// menangkap data yang dikirim dari form login

if($_SESSION['pamrh_level'] != 'admin')
{
    $_SESSION['pamrh_flash_error'] = "Login Terlebih Dahulu";
    header('location:../login.php');
}
else {
    $nama = $_POST['nama'];
    $p_kode = $_POST['kode'];
    $kode = strtoupper($p_kode);
    $query_cek_kode = mysqli_query($koneksi, "SELECT * FROM dusun WHERE kode='$kode'");
    $cek_kode = mysqli_num_rows($query_cek_kode);
    if($cek_kode > 0)
    {
        $_SESSION['pamrh_flash_error'] = "Kode Sudah Terpakai";
        header('location:../dusun_tambah.php');
    }
    else {
        
        mysqli_query($koneksi, "INSERT INTO dusun (nama, kode) VALUES ('$nama', '$kode')");

        $_SESSION['pamrh_flash_success'] = "Tambah Dusun Berhasil dengan kode <b>".$kode."</b>";
        header('location:../dusun.php');
    }
}

?>