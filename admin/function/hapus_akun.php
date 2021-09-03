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
    $id_akun = $_GET['id'];
    if($id_akun == null)
    {
        header('location: ../akun.php');
    }
    else {
        mysqli_query($koneksi, "DELETE FROM user WHERE id = '$id_akun'");
        $_SESSION['pamrh_flash_success'] = "Akun Berhasil di hapus";
        header('location:../akun.php');
    }
}

?>