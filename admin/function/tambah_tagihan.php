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
    $query_max_id = mysqli_query($koneksi, "SELECT max(id) as max_id FROM tagihan");
    $max_id = mysqli_fetch_array($query_max_id);
    if($max_id == null)
    {
        $id = 1;
    }
    else {
        $id =  $max_id['max_id']+1;
    }

    $id = $id; 
    $id_tagihan = $_POST['id_pelanggan_pelanggan'].'-'.date('d-m-Y');
    $id_pelanggan = $_POST['id_pelanggan'];
    $nama = $_POST['nama'];
    $tgl_cek = $_POST['tgl_cek'];
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];
    $pemakaian = (int)$_POST['akhir'] - (int)$_POST['awal'];
    $tagihan = $pemakaian*2000+5000;
    $status = 'butuh bayar';
    $metode_bayar = null;
    // $tgl_bayar = null;
    // $petugas_verifikasi = null;
    // $file = null;
    $meteran_img_name = $_FILES['bukti_cek']['name'];
    $meteran_img_size = $_FILES['bukti_cek']['size'];
    $meteran_tmp_name = $_FILES['bukti_cek']['tmp_name'];
    $meteran_error = $_FILES['bukti_cek']['error'];
    $create_at = date('Y-m-d');

    $where_bulan_pengecekan = date('m', strtotime($tgl_cek));
    $query_cek_bulan_pengecekan = mysqli_query($koneksi, "SELECT * FROM tagihan WHERE MONTH('create_at')='$where_bulan_pengecekan'");
    $cek_bulan_pengecekan = mysqli_num_rows($query_cek_bulan_pengecekan);

    if($cek_bulan_pengecekan >= 1)
    {
        $_SESSION['pamrh_flash_error'] = "Bulan Tersebut sudah terdapat tagihan";
        header("location: ../pelanggan_tagihan_tambah.php?id=$id_pelanggan");
    }
    else {
        if ($meteran_error === 0) {
            if ($meteran_img_size > 1024*10000) { //artinya: maksimal 10000kb = 10 MB (1kb = 1024 byte)
                $_SESSION['pamrh_flash_error'] = "Ukuran terlalu besar";
                header("location: ../pelanggan_tagihan_tambah.php?id=$id_pelanggan");
            }else {
                $img_ex = pathinfo($meteran_img_name, PATHINFO_EXTENSION);
                $img_ex_lc = strtolower($img_ex);

                $allowed_exs = array("jpg", "jpeg", "png"); 

                if (in_array($img_ex_lc, $allowed_exs)) {
                    $new_img_name = $id_tagihan.'.'.$img_ex_lc;
                    $img_upload_path = '../../assets/img/meteran/'.$new_img_name;
                    move_uploaded_file($meteran_tmp_name, $img_upload_path);

                    // query tmmbah data
                    $data = mysqli_query($koneksi, "INSERT INTO tagihan(id, id_tagihan, id_pelanggan, nama, tgl_cek, awal, akhir, foto_meteran, status, metode_bayar, pemakaian, tagihan) VALUES ('$id', '$id_tagihan', '$id_pelanggan', '$nama', '$tgl_cek', '$awal', '$akhir', '$new_img_name', '$status', '$metode_bayar', '$pemakaian', '$tagihan')");
                    
                    $_SESSION['pamrh_flash_success'] = "Tambah tagihan berhasil";
                    header("location: ../pelanggan_tagihan.php?id=$id_pelanggan");
                }else {
                    $_SESSION['pamrh_flash_error'] = "Tipe file tidak sesuai";
                    header("location: ../pelanggan_tagihan_tambah.php?id=$id_pelanggan");
                }
            }
        }else {
            $_SESSION['pamrh_flash_error'] = "Terdapat Error dalam file";
            header("location: ../pelanggan_tagihan_tambah.php?id=$id_pelanggan");
        }
    }
}

?>