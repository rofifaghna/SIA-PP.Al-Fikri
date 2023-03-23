<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SIA PP Al-Fikri</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../AdminLTE-3.2.0/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="../../index.php" class="navbar-brand">
        <img src="../../dist/img/omahngaji.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">SIA PPTQ Al-Fikri</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item">
            <a href="../../psb/index.php" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
                PSB (Pendaftaran Santri Baru)
            </a>
          </li>
          <li class="nav-item">
            <a href="kritik_saran.php" class="nav-link">
            <i class="nav-icon fas fa-edit"></i>
            Kritik Dan Saran
            </a>
          </li>
          <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">
            <i class="nav-icon fas fa-table"></i>.Informasi Pondok Pesantren
            </a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
              <li><a href="nilai_santri.php" class="dropdown-item">
              <i class="nav-icon fas fa-edit"></i>-Daftar Nilai Santri</a></li>
              <li><a href="poin.php" class="dropdown-item">
              <i class="nav-icon fas fa-pie-chart"></i>-Poin Pelanggaran Santri Santri</a></li>
            </ul>
          </li>
        </ul>

        <!-- SEARCH FORM -->
        <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </nav>
  <div class="content-wrapper">
</br>
    <div class="post text">

<!-- jumbotron -->
<div class="container">
    <section class="jumbotron text-center">
      <h1 class="display-4">Form Penginputan Kritik Dan Saran </h1>
      <hr class="my-4">     
    </section>
    </div>
    <!-- akhir jumbotron -->

<!-- form -->
<div class=" card container shadow-lg" style="width: 60rem;">
    <form method="post" action="aksi.php">
        <div class="mb-3">
            </br>
                <label class="form-label">Email</label>
                <input class="form-control" name="email" type="email" placeholder="Silahkan masukkan Email anda" aria-label="default input example">
            </br>
                <label class="form-label">Nama Pengirim</label>
                <input class="form-control" name="nama_pengirim" type="text" placeholder="Silahkan masukkan Nama anda" aria-label="default input example">
            </br>
                <label class="form-label">Kritik</label>
                <textarea class="form-control" name="kritik" type="text" placeholder="Silahkan masukkan Kritik anda" aria-label="default input example id="exampleFormControlTextarea1" rows="3"></textarea>
            </br>
                <label class="form-label">Saran</label>
                <textarea class="form-control" name="saran" type="text" placeholder="Silahkan masukkan Saran anda" aria-label="default input example id="exampleFormControlTextarea1" rows="3"></textarea>
            </br>
                <div class="col-12">
                <button class="btn btn-primary" type="submit" value="simpan">Submit form</button>
                </div>
        </div>
    </form>
</div>
<!-- akhir form -->
<!-- jQuery -->
<script src="../../AdminLTE-3.2.0/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../AdminLTE-3.2.0/dist/js/adminlte.min.js"></script>
  </body>
</html>