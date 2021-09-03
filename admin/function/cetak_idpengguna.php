<!DOCTYPE html>
<html>
<head>
    <title>Cetak Card</title>
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>

    .card {
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
      max-width: 50%;
      margin: auto;
      position: relative;
      text-align: left;
      font-family: arial;
    }
    @media (max-width: 1000px) {
      .card {
        max-width: 90%;
      }
    }

    .main {
        position: relative;
    }

    .content {
        padding: 20px;
        display: inline-block;
        position: relative;
        top: 0;
    }

    .title {
      color: grey;
      font-size: 18px;
    }

    .container {
      position: relative;
      text-align: center;
      color: white;
      margin: 0;
    }

    .centered {
      position: absolute;
      width: 100%;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    .table {
        width: 350px;
    }
    @media (max-width: 500px) {
      .table {
        width: 100%;
      }
    }

    h1 {
        line-height: 0px;
    }

    button {
      border: none;
      outline: 0;
      display: inline-block;
      padding: 8px;
      color: white;
      background-color: #000;
      text-align: center;
      cursor: pointer;
      width: 100%;
      font-size: 18px;
    }

    a {
      text-decoration: none;
      font-size: 22px;
      color: black;
    }

    button:hover, a:hover {
      opacity: 0.7;
    }
    </style>
</head>
<body>

    <br><br>
    <div class="card">
        <div class="container">
          <img src="../../assets/img/hearder.jpg" alt="John" style="width:100%; height:100px;">
          <div class="centered"><h3>Kartu Pelanggan<br>PAM Desa Sidawung</h3></div>
        </div>
      
      <?php 
        include '../../config/koneksi.php';
        $id = $_GET['id'];
        $query = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id_pelanggan = '$id'");
        while($data = mysqli_fetch_array($query)){
        ?>
            <center><h1><?php echo $data['nama']; ?></h1></center>
            <center><p class="title">ID Pelanggan: <?php echo $data['id_pelanggan']; ?></p></center>
            <div class="main">
            <div class="content">
            <table class="table">
                <tr>
                    <td>Dusun</td>
                    <td><?php echo $data['dusun']; ?></td>
                </tr>
                <tr>
                    <td>RT/RW</td>
                    <td><?php echo $data['rt']; ?>/<?php echo $data['rw']; ?></td>
                </tr>
                <tr>
                    <td>No. Rumah</td>
                    <td><?php echo $data['no_rumah']; ?></td>
                </tr>
                <tr>
                    <td>No. HP</td>
                    <td><?php echo $data['no_hp']; ?></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: justify; font-size: 12px;"><br>Scan QR Code dengan mengunjungi website PAM ROUDHOTUL HIDAYAH untuk pengecekan tagihan. Login menggunakan ID Pelanggan dan Kode Pelanggan yang ada pada kartu ini.</td>
                </tr>
            </table>
            </div>
            <div class="content">
            <table>
                <tr>
                    <td><img style="height:120px;" src="../../assets/img/qrcode/<?php echo $data['qrcode']; ?>"
        class="qr-code img-thumbnail col-12 img-responsive" /></td>
                </tr>
                <tr>
                    <td>Kode Pelanggan: <?php echo $data['code']; ?></td>
                </tr>
            </table>
            </div>
 
            </div>
        <?php 
        }
        ?>
        <div class="container">
          <img src="../../assets/img/hearder.jpg" alt="John" style="width:100%; height:70px;">
          <div class="centered">Hubungi kami di: <br>+62 123141231212 | admin.pam@roudhotulhidayah.com</div>
        </div>
    </div>
    <script>
        window.print();
    </script>
</body>
</html>