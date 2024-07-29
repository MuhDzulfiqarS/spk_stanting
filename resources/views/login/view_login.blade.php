<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>SPK STUNTING SAW</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="{{ asset('assets/img/logo.png')}}" rel="icon">
  <link href="{{ asset('assets/img/logo.png')}}" rel="apple-touch-icon">
  
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('fontawesome/css/all.min.css')}}">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('assets1/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets1/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
  <link href="{{ asset('assets1/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
  <link href="{{ asset('assets1/vendor/quill/quill.snow.css')}}" rel="stylesheet">
  <link href="{{ asset('assets1/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
  <link href="{{ asset('assets1/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
  <link href="{{ asset('assets1/vendor/simple-datatables/style.css')}}" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="{{ asset('assets1/css/style.css')}}" rel="stylesheet">

</head>

<body>

  <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="/" class="logo d-flex align-items-center w-auto">
                  <img src="assets/img/logo.png" alt="" style="height: 500px;">
                  <span class="d-none d-lg-block">SPK STUNTING SAW</span>
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Masuk ke Akun Anda</h5>
                    <p class="text-center small">Masukkan username dan password anda.</p>
                  </div>

                  <form action="{{ url('login/proses') }}" method="post" class="row g-3 needs-validation" novalidate>
                    @csrf
                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-user"></i></span>
                        <input type="text" name="username" class="form-control" id="username" value="{{ old('username') }}" required>
                        <div class="invalid-feedback">Masukkan username anda!</div>
                      </div>
                    </div>
                    

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" class="form-control" id="password"  required>
                        <div class="invalid-feedback">Masukkan password anda!</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn w-100" type="submit" style="background-color: #32CD32; color: #fff;">Login</button>
                    </div>

                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{ asset('assets1/vendor/apexcharts/apexcharts.min.js')}}"></script>
  <script src="{{ asset('assets1/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('assets1/vendor/chart.js/chart.umd.js')}}"></script>
  <script src="{{ asset('assets1/vendor/echarts/echarts.min.js')}}"></script>
  <script src="{{ asset('assets1/vendor/quill/quill.js')}}"></script>
  <script src="{{ asset('assets1/vendor/simple-datatables/simple-datatables.js')}}"></script>
  <script src="{{ asset('assets1/vendor/tinymce/tinymce.min.js')}}"></script>
  <script src="{{ asset('assets1/vendor/php-email-form/validate.js')}}"></script>

  <!-- Template Main JS File -->
  <script src="{{ asset('assets1/js/main.js')}}"></script>

</body>

</html>