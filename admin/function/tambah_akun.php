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
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $query_cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
    $cek_username = mysqli_num_rows($query_cek_username);
    if($cek_username > 0)
    {
        $_SESSION['pamrh_flash_error'] = "Username Sudah Terpakai";
        header('location:../akun_tambah.php');
    }
    else {
        
        mysqli_query($koneksi, "INSERT INTO user (nama, username, password) VALUES ('$nama', '$username', '$password')");

        $_SESSION['pamrh_flash_success'] = "Tambah akun berhasil";
        header('location:../akun.php');
    }
}

?>