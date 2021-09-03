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
    $id_dusun = $_GET['id'];
    if($id_dusun == null)
    {
        $_SESSION['pamrh_flash_error'] = "Dusun Gagal di hapus";
        header('location: ../dusun.php');
    }
    else {
        mysqli_query($koneksi, "DELETE FROM dusun WHERE id = '$id_dusun'");
        $_SESSION['pamrh_flash_success'] = "Dusun Berhasil di hapus";
        header('location:../dusun.php');
    }
}

?>