<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SPK STUNTING SAW PUSKESMAS</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png')}}" rel="icon">
  <link href="{{ asset('assets/img/logo.png')}}" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets/vendor/aos/aos.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css')}}" rel="stylesheet">

  <!-- CSS File -->
  <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top ">
  <div class="container d-flex align-items-center justify-content-between">

    <h1 class="logo"><a href="index.html">SPK STUNTING SAW</a></h1>


    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
        <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
        <li><a class="nav-link scrollto" href="#services">Persyaratan</a></li>
        </li>
        <li><a class="nav-link scrollto" href="#contact">Kontak</a></li>
        <li><a class="getstarted scrollto" href="{{ url('login') }}">Login</a></li>
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav><!-- .navbar -->

  </div>
</header><!-- End Header -->

<!-- ======= Hero Section ======= -->
<section id="hero">
  <div class="hero-container" data-aos="fade-up" data-aos-delay="150">
    <h1>SPK STUNTING SAW</h1>
    <h2>SISTEM PENDUKUNG KEPUTUSAN PENENTUAN
      STUNTING SAW DI PUSKESMAS
      TOGO-TOGO</h2>
    <div class="d-flex">
      <a href="#about" class="btn-get-started scrollto">Jelajahi</a>
      <a href="https://www.youtube.com/@puskesmastogo-togo2451" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
    </div>
  </div>
</section><!-- End Hero -->

<main id="main">

  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container" data-aos="fade-up">

      <div class="row">

        <div class="col-lg-5 video-box align-self-baseline" data-aos="zoom-in" data-aos-delay="100">
          <img src="assets/img/features-1.png" class="img-fluid" alt="" height="200" width="400" style="margin-left: 60px;">
          <!-- Menentukan tinggi gambar menjadi 100 piksel -->
          <a href="https://www.youtube.com/@puskesmastogo-togo2451" class="glightbox play-btn mb-4"></a>
        </div>

        <div class="col-lg-6 pt-3 pt-lg-0 content mt-2">
          <h3>Sistem Pendukung Keputusan Penentuan Stunting Menggunakan Metode Simple Additive Weigthing (Saw) Di Puskesmas Togo-Togo Kecamatan Batang Kabupaten Jeneponto</h3>
          <p class="fst-italic">
            Adapun kriteria stunting yang dideteksi pada sistem ini adalah sebagai berikut:
          </p>
          <ul>
            <li><i class="bx bx-check-double"></i> TBU: Tinggi Badan per Umur</li>
            <li><i class="bx bx-check-double"></i> BBU: Berat Badan per Umur</li>
            <li><i class="bx bx-check-double"></i> BBTU: Berat Badan per Tinggi Badan</li>
            <li><i class="bx bx-check-double"></i> IMT/U: Indeks Massa Tubuh per Umur</li>
          </ul>
          <p>
            Dengan menerapkan metode SAW yang lebih terstruktur dan terukur dalam penentuan stunting, di Puskesmas Togo- Togo
Kec.batang Kab. jeneponto dapat memberikan layanan kesehatan yang lebih berkualitas kepada masyarakat
          </p>
        </div>

      </div>

    </div>
  </section><!-- End About Section -->

  <!-- ======= About Boxes Section ======= -->
  <section id="about-boxes" class="about-boxes">
    <div class="container" data-aos="fade-up">

      <div class="row">
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
          <div class="card">
            <img src="assets/img/about-boxes-1.jpg" class="card-img-top" alt="...">
            <div class="card-icon">
              <i class="ri-brush-4-line"></i>
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="">Input Data Pasien</a></h5>
              <p class="card-text">Input Data secara lengkap dan tepat berdasarkan informasi yang ada dari pasien </p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="200">
          <div class="card">
            <img src="assets/img/about-boxes-2.jpg" class="card-img-top" alt="...">
            <div class="card-icon">
              <i class="ri-movie-2-line"></i>
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="">Training Data Pasien</a></h5>
              <p class="card-text">Lakukan training data di sistem dan menghitung presentase berdasarkan rumus yang telah ditentukan</p>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="300">
          <div class="card">
            <img src="assets/img/about-boxes-3.jpg" class="card-img-top" alt="...">
            <div class="card-icon">
              <i class="ri-calendar-check-line"></i>
            </div>
            <div class="card-body">
              <h5 class="card-title"><a href="">Hasil Training Data</a></h5>
              <p class="card-text">User bisa melihat hasil training di website apakah stunting normal dan tidak normal</p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End About Boxes Section -->

  <!-- ======= Services Section ======= -->
  <section id="services" class="services section-bg">
    <div class="container" data-aos="fade-up">

      <div class="section-title">
        <h2>Persyaratan</h2>
        <p>Persyaratan Kebutuhan User</p>
      </div>

      <div class="row" data-aos="fade-up" data-aos-delay="200">
        <div class="col-md-6">
          <div class="icon-box">
            <i class="bi bi-laptop"></i>
            <h4><a href="#">Create User</a></h4>
            <p>Silahkan menguhubungi kontak atau mendatangi kantor puskesmas untuk dibuatkan akun oleh admin</p>
          </div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
          <div class="icon-box">
            <i class="bi bi-bar-chart"></i>
            <h4><a href="#">Siapkan Data Pasien</a></h4>
            <p>Silahkan siapkan data pasien yang anda mau training untuk pengambilan keputusan stunting</p>
          </div>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
          <div class="icon-box">
            <i class="bi bi-brightness-high"></i>
            <h4><a href="#">Lihat Hasil Training Data</a></h4>
            <p>Training data berbentuk laporan dan hasil bisa dilihat disistem user</p>
          </div>
        </div>
      </div>

    </div>
  </section><!-- End Services Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container" data-aos="fade-up"">

  <div class=" section-title">
      <h2>Kontak</h2>
      <p>Kontak</p>
    </div>

    <div class="row">

      <div class="col-lg-6">

        <div class="row">
          <div class="col-md-12">
            <div class="info-box">
              <i class="bx bx-map"></i>
              <h3>Our Address</h3>
              <p>Jl. Poros Jeneponto Bantaeng, Togo-Togo, Kec. Batang, Kabupaten Jeneponto, Sulawesi Selatan 92361</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-box mt-4">
              <i class="bx bx-envelope"></i>
              <h3>Email Us</h3>
              <p>puskesmastogo@gmail.com</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="info-box mt-4">
              <i class="bx bx-phone-call"></i>
              <h3>Call Us</h3>
              <p> (0419) 2425660</p>
            </div>
          </div>
        </div>

      </div>

      <div class="col-lg-6 mt-4 mt-lg-0">
        <form action="forms/contact.php" method="post" role="form" class="php-email-form">
          <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
          </div>
          <div class="text-center"><button type="submit">Send Message</button></div>
        </form>
      </div>

    </div>

    </div>
  </section><!-- End Contact Section -->

</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer">
  <div class="footer-top">
    <div class="container">
      <div class="row">

        <div class="col-lg-3 col-md-6">
          <div class="footer-info">
            <h3>SPK STUNTING SAW</h3>
            <p>
              9RFG+6JM Jeneponto <br>
              Sulawesi Selatan 92361<br><br>
              <strong>Phone:</strong> (0419) 2425660<br>
              <strong>Email:</strong>puskesmastogo@gmail.com<br>
            </p>
            <div class="social-links mt-3">
              <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
              <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
              <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
              <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
              <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-2 col-md-6 footer-links">
          <h4>Menu</h4>
          <ul>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Tentang</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Persyaratan</a></li>
            <li><i class="bx bx-chevron-right"></i> <a href="#">Kontak</a></li>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-newsletter">
          <h4>Subscribe</h4>
          <p>Silahkan Subscribe Akun Kami</p>
          <form action="" method="post">
            <input type="email" name="email"><input type="submit" value="Subscribe">
          </form>

        </div>

      </div>
    </div>
  </div>

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>SPK STUNTING SAW</span></strong>. All Rights Reserved
    </div>
  </div>
</footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{asset('assets/vendor/aos/aos.js')}}"></script>
  <script src="{{asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('assets/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{asset('assets/js/main.js')}}"></script>

</body>

</html>