<?php

require 'connection.php';

// set cookies
_cookie();

// set session
if (!isset($_SESSION["Developer"])) {
  header('location: login.php');
  exit;
} else {
  if (isset($_SESSION['id_users'])) {
    $id_users = $_SESSION['id_users'];
  } else {
    $id_users = $_COOKIE['id_users'];
  }

  $user = lihat("SELECT * FROM tb_users WHERE id_users = '$id_users' ")[0];
}

_timeout();


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Developer Dashboard</title>
  <link href="dashboard/css/app.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <!-- sidebar -->
    <nav id="sidebar" class="sidebar">
      <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="developer_dashboard.php">
          <span class="align-middle">Halaman Developer</span>
        </a>

        <ul class="sidebar-nav">
          <li class="sidebar-header">
            Pages
          </li>

          <li class="sidebar-item active">
            <a class="sidebar-link" href="developer_dashboard.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
          </li>

        </ul>
      </div>
    </nav>

    <div class="main">
      <!-- navbar -->
      <nav class="navbar navbar-expand navbar-light navbar-bg">
        <a class="sidebar-toggle d-flex">
          <i class="hamburger align-self-center"></i>
        </a>

        <div class="navbar-collapse collapse">
          <ul class="navbar-nav navbar-align">

            <!-- profile -->
            <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
              <img src="dashboard/img/avatars/avatar.jpg" class="avatar img-fluid rounded mr-1" alt="developer" /> <span class="text-dark">
                <?= $user["username"] ?>
              </span>
            </a>

            <div class="dropdown-menu dropdown-menu-right mt-4">
              <a class="dropdown-item" href="logout.php" onclick="return confirm('Yakin ingin Logout?')">Log out</a>
            </div>
            </li>
          </ul>
        </div>
      </nav>

      <main class="content">
        <div class="container-fluid p-0">

          <div class="row mb-2 mb-xl-3">
            <div class="col-auto d-none d-sm-block">
              <h3><strong>Developer</strong> Dashboard</h3>
            </div>

          </div>

          <div class="row">

            <div class="col-12 col-md-12 d-flex order-3 order-xxl-2">
              <div class="card flex-fill w-100">
                <div class="card-header">
                  <h5 class="card-title mb-0"><strong>Dashboard</strong></h5>
                </div>
                <div class="card-body px-4">
                  <h1>Latar Belakang</h1>
                  <p align="justify"> Dalam kehidupan manusia pasti ada masalah yang timbul. Masalah yang dihadapi manusia bermacam-macam mulai dari yang kecil sampai masalah yang besar yang mungkin memerlukan waktu pemecahan yang lama. Memberikan pemecahan masalah secara langsung atau memberi beberapa alternative solusi untuk pemecahan masalah</p>
                  <p align="justify"> Salah satunya seperti sebuah perusahaan atau instansi yang akan berhati-hati dalam menyeleksi calon developer yang nantinya akan menjadi developer di perusahaan tersebut
                  </p>
                  <p align="justify"> Sebuah perusahaan atau instansi akan berhati-hati dalam menyeleksi calon developer yang nantinya akan menjadi developer di perusahaan tersebut. Kesalahan dalam memilih seorang developer tentunya akan membawa pengaruh negatif bagi kinerja perusahaan. Selain menilai pada kemapuan teknis, perusahaan juga perlu melakukan penilaian kepribadian terhadap calon developer.Oleh karena itu diperlukan metode yang sistematis dan seleksi yang tepat dalam pemilihan calon developer baru</p>

                </div>
              </div>
            </div>
          </div>

        </div>
      </main>


    </div>
  </div>

  <script src="dashboard/js/app.js"></script>
</body>


</html>