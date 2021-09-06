<?php
    session_start();
    $thisPage = 'tagihan';
    
    include '../config/koneksi.php';

    if(isset($_SESSION['pamrh_level']) && $_SESSION['pamrh_level'] == "pelanggan")
    {
        $id_pelanggan_login = $_SESSION['pamrh_id_pelanggan'];
        $query_pelanggan_login = mysqli_query($koneksi, "SELECT * FROM pelanggan WHERE id='$id_pelanggan_login'");
        $pelanggan_login = mysqli_fetch_assoc($query_pelanggan_login);
    }

    include 'layout/header.php';
  
?>

  <div class="page-banner overlay-dark bg-image" style="background-image: url('../assets/img/gmb-4.png');">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Scan</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Scan</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container-fluid p-3">
      <div class="row justify-content-center">
        <div class=" col-lg-4 col-md-6 wow fadeInUp">          
          <div class="text-lg">
            <canvas class="col-12"></canvas>
            <hr>
            <select class="input-select"></select>
            <hr>
            <ul></ul>
            
          </div>
        </div>
      </div>
    </div>
  </div>
  
            <script type="text/javascript">
                var txt = "innerText" in HTMLElement.prototype ? "innerText" : "textContent";
                var arg = {
                    resultFunction: function(result) {
                        var aChild = document.createElement('li');
                        aChild[txt] = result.format + ': ' + result.code;
                        document.querySelector('body').appendChild(aChild);
                        console.log(result.code);
                        window.location.replace("scan_tagihan.php?id="+result.code);
                    }
                };
                var decoder = new WebCodeCamJS("canvas").buildSelectMenu('select', 'environment|back').init(arg).play();
                /*  Without visible select menu
                    var decoder = new WebCodeCamJS("canvas").buildSelectMenu(document.createElement('select'), 'environment|back').init(arg).play();
                */
                document.querySelector('select').addEventListener('change', function(){
                    decoder.stop().play();
                });
            </script>
  
<?php
include_once('layout/footer.php');
?>