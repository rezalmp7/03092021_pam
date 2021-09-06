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
    $id = $_POST['id']; 
    $session_id = $_SESSION['pamrh_id_admin'];
    $query_petugas_verifikasi = mysqli_query($koneksi, "SELECT * FROM user WHERE id='$session_id'");
    $data_petugas_verifikasi = mysqli_fetch_array($query_petugas_verifikasi);
    $petugas_verifikasi = $data_petugas_verifikasi['nama'];
    $id_pelanggan = $_POST['id_pelanggan'];

    $status = 'lunas';
    $id_tagihan = $_POST['id_tagihan'];
    $metode_bayar = $_POST['metode'];


    // query tmmbah data
    mysqli_query($koneksi, "UPDATE tagihan SET metode_bayar='$metode_bayar', status='$status' ,petugas_verifikasi='$petugas_verifikasi' WHERE id='$id'");
                    
    $_SESSION['pamrh_flash_success'] = "Pembayaran tagihan berhasil";
    header("location: ../pelanggan_tagihan.php?id=".$id_pelanggan);
}

?>