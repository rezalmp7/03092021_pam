
<?php
$thisPage = 'login';
include_once('layout/header.php');
?>

  <div class="page-banner overlay-dark bg-image" style="background-image: url('./assets/img/gmb-2.png');">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Login</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Login</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container">
        <h2 class="text-center">Login</h2>
        <form class="col-md-4 mx-auto" method="POST" action="function/login.php">
            <div class="form-group">
                <label for="exampleInputEmail1">Username</label>
                <input type="text" class="form-control" name="username" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="password" placeholder="Password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
        
        <div class="alert alert-warning" role="alert">
            <h4 class="alert-heading">Note!</h4>
            <hr />
            <p>
                <b>Username</b> adalah ID Pelanggan Anda contoh BLR001122<br>
                <b>Password</b> adalah Code di kartu pelanggan anda
            </p>
        </div>
    </div>
  </div>

<?php
include_once('layout/footer.php');
?>