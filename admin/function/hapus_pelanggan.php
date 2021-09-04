<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../../config/koneksi.php';

// menangkap data yang dikirim dari form login

$id_pelanggan = $_GET['id'];
$query_data_pelanggan = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id_pelanggan'");
$data_pelanggan = mysqli_fetch_array($query_data_pelanggan);

if($_SESSION['pamrh_level'] != 'admin')
{
    $_SESSION['pamrh_flash_error'] = "Login Terlebih Dahulu";
    header('location:../login.php');
}
else {
    if($id_pelanggan == null)
    {
        $_SESSION['pamrh_flash_error'] = "Pelanggan Gagal di hapus";
        header('location: ../pelanggan.php');
    }
    else {
        mysqli_query($koneksi, "DELETE FROM pelanggan WHERE id = '$id_pelanggan'");
        unlink("../../assets/img/qrcode/".$data_pelanggan['qrcode']);

        $_SESSION['pamrh_flash_success'] = "Pelanggan Berhasil di hapus";
        header('location:../pelanggan.php');
    }
}

?>