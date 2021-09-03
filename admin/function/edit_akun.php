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
    $id = $_POST['id'];
    if($_POST['password'] == null)
    {
        $password = $_POST['password_lama'];
    }
    else {
        $password = md5($_POST['password']);
    }

    if($_POST['username_lama'] == $_POST['username'])
    {
        mysqli_query($koneksi, "UPDATE user SET nama='$nama', username='$username', password='$password' WHERE id='$id'");

        $_SESSION['pamrh_flash_success'] = "Edit akun berhasil";
        header('location:../akun.php');
    }
    else 
    {
        $query_cek_username = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$username'");
        $cek_username = mysqli_num_rows($query_cek_username);
        if($cek_username > 0)
        {
            $_SESSION['pamrh_flash_error'] = "Username Sudah Terpakai";
            header("location:../akun_edit.php?id=".$id);
        }
        else {
            
            mysqli_query($koneksi, "UPDATE user SET nama='$nama', username='$username', password='$password' WHERE id='$id'");

            $_SESSION['pamrh_flash_success'] = "Edit akun berhasil";
            header('location:../akun.php');
        }
    }
}

?>