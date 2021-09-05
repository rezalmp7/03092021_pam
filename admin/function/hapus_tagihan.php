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
    $id_tagihan = $_GET['id_tagihan'];
    $id_pelanggan = $_GET['id'];
    if($id_tagihan == null)
    {
        $_SESSION['pamrh_flash_error'] = "Tagihan Gagal di hapus";
        header('location: ../tagihan.php?id='.$id_pelanggan);
    }
    else {
        $query_data_tagihan = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE id='$id_tagihan'");
        $data_tagihan = mysqli_fetch_array($query_data_tagihan);

        unlink('../../assets/img/meteran/'.$data_tagihan['foto_meteran']);

        mysqli_query($koneksi, "DELETE FROM tagihan WHERE id = '$id_tagihan'");
        $_SESSION['pamrh_flash_success'] = "Tagihan Berhasil di hapus";
        header('location:../pelanggan_tagihan.php?id='.$id_pelanggan);
    }
}

?>