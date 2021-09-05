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
    $id_tagihan = $_POST['id_pelanggan_pelanggan'].'-'.date('d-m-Y');
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $tgl_cek = $_POST['tgl_cek'];
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];
    $pemakaian = $_POST['akhir']-$_POST['awal'];
    $tagihan = $pemakaian*2000+5000;
    $status = 'butuh bayar';
    $metode_bayar = null;
    // $tgl_bayar = null;
    // $petugas_verifikasi = null;
    // $file = null;
    $foto_meteran_lama = $_POST['foto_meteran_lama'];
    $meteran_img_name = $_FILES['bukti_cek']['name'];
    $meteran_img_size = $_FILES['bukti_cek']['size'];
    $meteran_tmp_name = $_FILES['bukti_cek']['tmp_name'];
    $meteran_error = $_FILES['bukti_cek']['error'];
    $create_at = date('Y-m-d');

    if($meteran_img_name != '')
    {
        if($meteran_error === 0) {
            if ($meteran_img_size > 1024*10000) { //artinya: maksimal 10000kb = 10 MB (1kb = 1024 byte)
                $_SESSION['pamrh_flash_error'] = "Ukuran terlalu besar";
                header("location: ../pelanggan_tagihan_edit.php?id='$id_pelanggan'&id_tagihan='$id'");
            }else {
                $img_ex = pathinfo($meteran_img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png"); 

                if (in_array($img_ex_lc, $allowed_exs)) {
                    unlink('../../assets/img/meteran/'.$foto_meteran_lama);
                    $new_img_name = $id_tagihan.'.'.$img_ex_lc;
                    $img_upload_path = '../../assets/img/meteran/'.$new_img_name;
                    move_uploaded_file($meteran_tmp_name, $img_upload_path);

                    // query tmmbah data
                    mysqli_query($koneksi, "UPDATE tagihan SET id_tagihan='$id_tagihan', id_pelanggan='$id_pelanggan', nama='$nama', tgl_cek='$tgl_cek', awal='$awal', akhir='$akhir', foto_meteran='$new_img_name', status='$status', metode_bayar='$metode_bayar', pemakaian='$pemakaian', tagihan='$tagihan' WHERE id='$id'");
                    
                    $_SESSION['pamrh_flash_success'] = "Tambah tagihan berhasil";
                    header("location: ../pelanggan_tagihan.php?id=$id_pelanggan");
                }else {
                    $_SESSION['pamrh_flash_error'] = "Tipe file tidak sesuai";
                    header("location: ../pelanggan_tagihan_edit.php?id='$id_pelanggan'&id_tagihan='$id'");
                }
            }
        }else {
            $_SESSION['pamrh_flash_error'] = "Terdapat Error dalam file";
            header("location: ../pelanggan_tagihan_edit.php?id='$id_pelanggan'&id_tagihan='$id'");
        }
    }
    else {
        mysqli_query($koneksi, "UPDATE tagihan SET id_tagihan='$id_tagihan', id_pelanggan='$id_pelanggan', tgl_cek='$tgl_cek', awal='$awal', akhir='$akhir', pemakaian='$pemakaian', tagihan='$tagihan' WHERE id='$id'");
        $_SESSION['pamrh_flash_success'] = "Tambah tagihan berhasil";
        header("location: ../pelanggan_tagihan.php?id=$id_pelanggan");
    }
}

?>