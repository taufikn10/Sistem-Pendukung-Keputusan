<?php

require 'connection.php';

// set cookies
_cookie();

// set session
if (!isset($_SESSION["Admin"])) {
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

<?php
// KONFIGURASI PAGINATION
$jumlahDataPerHalaman = 5;
$jumlahData = count(lihat("SELECT * FROM tb_kriteria"));
$jumlahHalaman =  ceil($jumlahData / $jumlahDataPerHalaman);
$halamanAktif = (isset($_GET["halaman"])) ? $_GET["halaman"] : 1;
$awalData = ($jumlahDataPerHalaman * $halamanAktif) - $jumlahDataPerHalaman;

//QUERY :
$data_kriteria = lihat("SELECT * FROM tb_kriteria LIMIT $awalData, $jumlahDataPerHalaman");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Kriteria</title>
  <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.css">
  <link href="dashboard/css/app.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <!-- sidebar -->
    <nav id="sidebar" class="sidebar">
      <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="admin_dashboard.php">
          <span class="align-middle">Halaman Admin</span>
        </a>

        <ul class="sidebar-nav">
          <li class="sidebar-header">
            Pages
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="admin_dashboard.php">
              <i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
            </a>
          </li>

          <li class="sidebar-item active">
            <a class="sidebar-link" href="admin_kriteria.php">
              <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">Data Kriteria</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="admin_bobotKriteria.php">
              <i class="align-middle" data-feather="layers"></i> <span class="align-middle">Bobot Kriteria</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="admin_developer.php">
              <i class="align-middle" data-feather="list"></i> <span class="align-middle">Data Developer</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="admin_nilaiDev.php">
              <i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Nilai Developer</span>
            </a>
          </li>

          <li class="sidebar-item">
            <a class="sidebar-link" href="admin_user.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data User</span>
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
              <img src="dashboard/img/avatars/avatar.jpg" class="avatar img-fluid rounded mr-1" alt="admin" />
              <span class="text-dark"><?= $user["username"] ?></span>
            </a>

            <div class="dropdown-menu dropdown-menu-right mt-4">
              <a class="dropdown-item" href="logout.php" onclick="return confirm('Yakin ingin Logout?')">Log out</a>
            </div>
            </li>
          </ul>
        </div>
      </nav>

      <!-- Table -->
      <main class="content">
        <div class="container-fluid p-0">

          <h1 class="h3 mb-3">Data Kriteria</h1>

          <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#tambah">Tambah Kriteria</button>

          <div id="tambah" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 style="color: black;" class="modal-title">Tambah Kriteria</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="modal-body py-3">
                    <div class="form-group">
                      <label style="color: black;" for="control-label" for="kode">Kode</label>
                      <input type="text" name="kode" class="form-control" id="kode" required>
                    </div>
                    <div class="form-group mt-2">
                      <label style="color: black;" for="control-label" for="range">Nama Kriteria</label>
                      <input type="text" name="range" class="form-control" id="range" required>
                    </div>
                    <div class="form-group mt-2">
                      <label style="color: black;" for="control-label" for="range">Definisi</label>
                      <input type="text" name="range" class="form-control" id="range" required>
                    </div>
                    <div class="form-group mt-2">
                      <label style="color: black;" for="control-label" for="jenis">Jenis</label>
                      <input type="text" name="jenis" class="form-control" id="jenis" required>
                    </div>
                    <div class="form-group mt-2">
                      <label style="color: black;" for="control-label" for="bobot">Bobot(W)</label>
                      <input type="text" name="bobot" class="form-control" id="bobot" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="cancel" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="add" class="btn btn-success">submit</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-center">Kriteria Usability</h3>
                  <hr>
                </div>
                <div class="table-responsive">
                  <table class="table mb-0 table table-bordered border-primary">
                    <thead class="">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Kriteria</th>
                        <th scope="col">Definisi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      <?php foreach ($data_kriteria as $dk) : ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $dk["kode"]; ?></td>
                          <td><?= $dk["nama_kriteria"]; ?></td>
                          <td><?= $dk["definisi"]; ?></td>
                          <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#upgrade-user">
                              edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-user">
                              Delete
                            </button>
                          </td>
                        </tr>
                        <?php $no++ ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>

            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-center">Data Kriteria</h3>
                  <hr>
                </div>
                <div class="table-responsive">
                  <table class="table mb-0 table table-bordered border-primary">
                    <thead class="">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kode</th>
                        <th scope="col">Nama Kriteria</th>
                        <th scope="col">Jenis</th>
                        <th scope="col">Bobot (W)</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      <?php foreach ($data_kriteria as $dk) : ?>
                        <tr>
                          <td><?= $no; ?></td>
                          <td><?= $dk["kode"]; ?></td>
                          <td><?= $dk["nama_kriteria"]; ?></td>
                          <td><?= $dk["jenis"]; ?></td>
                          <td><?= $dk["bobot"]; ?></td>
                          <td>
                            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#upgrade-user">
                              edit
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#delete-user">
                              Delete
                            </button>
                          </td>
                        </tr>
                        <?php $no++ ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- start pagination -->
        <div class="justify-content-center">
          <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">

              <!-- satrt tanda panah menurun -->
              <li class="page-item" style="cursor: pointer;">
                <?php if ($halamanAktif > 1) : ?>
                  <a class="page-link" href="admin_dataUser.php?halaman=<?= $halamanAktif - 1; ?>#content" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                <?php else : ?>
                  <a class="page-link" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                    <span class="sr-only">Previous</span>
                  </a>
                <?php endif; ?>
              </li>
              <!-- end tanda panah menurun-->

              <!-- start pagination menampilkan halaman -->
              <?php for ($i = 1; $i <= $jumlahHalaman; $i++) : ?>
                <?php if ($i == $halamanAktif) : ?>
                  <li class="page-item active">
                    <a class="page-link" href="admin_kriteria.php?halaman=<?= $i; ?>#content">
                      <span><?= $i; ?></span>
                    </a>
                  </li>
                <?php else : ?>
                  <li class="page-item">
                    <a class="page-link" href="admin_kriteria.php?halaman=<?= $i; ?>#content">
                      <span><?= $i; ?></span>
                    </a>
                  </li>
                <?php endif; ?>
              <?php endfor; ?>
              <!-- end pagination menampilkan halaman -->

              <!-- start tanda panah tambah -->
              <li class="page-item" style="cursor: pointer;">
                <?php if ($halamanAktif < $jumlahHalaman) : ?>
                  <a class="page-link" href="admin_kriteria.php?halaman=<?= $halamanAktif + 1; ?>#content" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                <?php else : ?>
                  <a class="page-link" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                  </a>
                <?php endif; ?>
              </li>

            </ul>
          </nav>
        </div>
        <!-- end pagination -->
      </main>
    </div>
  </div>


  <!-- Popper Script-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <!-- Bootstrap Script -->
  <script src="asset/bootstrap/js/bootstrap.js"></script>
  <script src="dashboard/js/app.js"></script>
</body>

</html>