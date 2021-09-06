<?php 
// mengaktifkan session pada php
session_start();

// menghubungkan php dengan koneksi database
include '../../config/koneksi.php';

// menangkap data yang dikirim dari form login

if($_SESSION['pamrh_level'] != 'pelanggan')
{
    $_SESSION['pamrh_flash_error'] = "Login Terlebih Dahulu";
    header('location:../login.php');
}
else {
    $id = $_POST['id']; 
    $tgl_bayar = date('Y-m-d H:i:s');
    $petugas_verifikasi = null;
    $status = 'butuh konfirmasi';
    $id_tagihan = $_POST['id_tagihan'];
    $pembayaran_img_name = $_FILES['bukti_pembayaran']['name'];
    $pembayaran_img_size = $_FILES['bukti_pembayaran']['size'];
    $pembayaran_tmp_name = $_FILES['bukti_pembayaran']['tmp_name'];
    $pembayaran_error = $_FILES['bukti_pembayaran']['error'];
    $create_at = date('Y-m-d');
    $foto_pembayaran_lama = $_POST['gambar_lama'];

    $query_cek_id_pelanggan = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE id='$id'");
    $cek_id_pelanggan = mysqli_fetch_array($query_cek_id_pelanggan);

    $session_id_pelanggan = $_SESSION['pamrh_id_pelanggan'];
    if($cek_id_pelanggan['id_pelanggan'] == $session_id_pelanggan)
    {
        if($pembayaran_error === 0) {
            if ($pembayaran_img_size > 1024*10000) { //artinya: maksimal 10000kb = 10 MB (1kb = 1024 byte)
                $_SESSION['pamrh_flash_error'] = "Ukuran Foto terlalu besar";
                header("location: ../tagihan_bayar.php?id='$id'");
            }else {
                unlink('../../assets/img/pembayaran/'.$foto_pembayaran_lama);

                $img_ex = pathinfo($pembayaran_img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png"); 

                if (in_array($img_ex_lc, $allowed_exs)) {
                    unlink('../../assets/img/pembayaran/'.$foto_pembayaran_lama);
                    $new_img_name = $id_tagihan.'.'.$img_ex_lc;
                    $img_upload_path = '../../assets/img/pembayaran/'.$new_img_name;
                    move_uploaded_file($pembayaran_tmp_name, $img_upload_path);

                    // query tmmbah data
                    mysqli_query($koneksi, "UPDATE tagihan SET tgl_bayar='$tgl_bayar' ,file='$new_img_name', status='$status' WHERE id='$id'");
                    
                    $_SESSION['pamrh_flash_success'] = "Edit Pembayaran tagihan berhasil";
                    header("location: ../tagihan.php?id=$id");
                }else {
                    $_SESSION['pamrh_flash_error'] = "Tipe File harus jpg/jpeg/png";
                    header("location: ../tagihan_bayar.php?id='$id'");
                }
            }
        }else {
            $_SESSION['pamrh_flash_error'] = "Terdapat Error dalam file";
            header("location: ../tagihan_bayar.php?id='$id'");
        }
    }
    else {
        $_SESSION['pamrh_flash_error'] = "Pakai user yang sama dengan tagihan pengguna";
            header("location: ../tagihan.php");
    }
}

?>