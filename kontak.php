
<?php
$thisPage = 'kontak';
include_once('layout/header.php');
?>

  <div class="page-banner overlay-dark bg-image" style="background-image: url(./assets/img/gmb-3.jpg);">
    <div class="banner-section">
      <div class="container text-center wow fadeInUp">
        <nav aria-label="Breadcrumb">
          <ol class="breadcrumb breadcrumb-dark bg-transparent justify-content-center py-0 mb-2">
            <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Kontak Kami</li>
          </ol>
        </nav>
        <h1 class="font-weight-normal">Kontak Kami</h1>
      </div> <!-- .container -->
    </div> <!-- .banner-section -->
  </div> <!-- .page-banner -->

  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Get in Touch</h1>

      <form class="contact-form mt-5" method="POST" action="function/tambah_kontak.php">
        <div class="row mb-3">
          <div class="col-sm-6 py-2 wow fadeInLeft">
            <label for="fullName">Name</label>
            <input type="text" id="fullName" name="nama" class="form-control" placeholder="Full name.." required>
          </div>
          <div class="col-sm-6 py-2 wow fadeInRight">
            <label for="emailAddress">Email</label>
            <input type="text" id="emailAddress" name="email" class="form-control" placeholder="Email address.." required>
          </div>
          <div class="col-12 py-2 wow fadeInUp">
            <label for="message">Pesan</label>
            <textarea id="message" class="form-control" name="pesan" rows="8" placeholder="Enter Message.." required></textarea>
          </div>
        </div>
        <button type="submit" class="btn btn-primary wow zoomIn">Send Message</button>
      </form>
    </div>
  </div>

  <div class="wow fadeInUp">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d142244.60193493433!2d110.34110161640956!3d-6.988928337315503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70f38bd34a4791%3A0xc7ba2f15f268a251!2sTop%20Up%20Game%2C%20Pulsa%2Clistrik%2CPam%20Dll!5e0!3m2!1sen!2sid!4v1630555460228!5m2!1sen!2sid" width="100%" style="border:0; aspect-ratio: 16/4;" allowfullscreen="" loading="lazy"></iframe>
  </div>


<?php
include_once('layout/footer.php');
?>