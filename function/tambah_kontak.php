<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../config/koneksi.php';

// menangkap data yang dikirim dari form login
$nama = $_POST['nama'];
$email = $_POST['email'];
$pesan = $_POST['pesan'];

mysqli_query($koneksi, "INSERT INTO kontak (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')");
$_SESSION['pamrh_flash_success'] = "Pesan telah terkirim";
header('location:../kontak.php');

?>