<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../config/koneksi.php';

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];

$password_admin = md5($_POST['password']);

// menyeleksi data user dengan username dan password yang sesuai
$login_pelanggan = mysqli_query($koneksi,"select * from pelanggan where id_pelanggan='$username' and code='$password'");
$login_admin = mysqli_query($koneksi,"select * from user where username='$username' and password='$password_admin'");
// menghitung jumlah data yang ditemukan
$cek_pelanggan = mysqli_num_rows($login_pelanggan);
$cek_admin = mysqli_num_rows($login_admin);

// cek apakah username dan password di temukan pada database
if($cek_pelanggan > 0){

	$data = mysqli_fetch_assoc($login_pelanggan);

	// buat session login dan username
	$_SESSION['pamrh_id_pelanggan'] = $data['id'];
	$_SESSION['pamrh_level'] = "pelanggan";
	// alihkan ke halaman dashboard admin
	$_SESSION['pamrh_flash_success'] = "Selamat Datang ".$data['nama'];
	header("location:./pelanggan/index.php");
}
elseif ($cek_admin > 0) {
    $data = mysqli_fetch_assoc($login_admin);

	// buat session login dan username
	$_SESSION['pamrh_id_admin'] = $data['id'];
	$_SESSION['pamrh_level'] = "admin";
	// alihkan ke halaman dashboard admin
	$_SESSION['pamrh_flash_success'] = "Selamat Datang ".$data['nama'];
	header("location:../admin/index.php");
}
else{
	$_SESSION['pamrh_flash_error'] = "User Tidak Ditemukan";
	header("location:../login.php");
}



?>