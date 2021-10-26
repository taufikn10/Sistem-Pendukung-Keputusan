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

// $saw = new Saw();
?>

<?php
//QUERY :
$data_user = lihat("SELECT * FROM tb_users WHERE level = 'Developer'");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data User</title>
  <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.css">
  <link href="dashboard/css/app.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>
  <div class="wrapper">
    <!-- Side Bar -->
    <nav id="sidebar" class="sidebar">
      <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="admin_dashboard.php">
          <span class="align-middle">Halaman admin</span>
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

          <li class="sidebar-item">
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

          <li class="sidebar-item active">
            <a class="sidebar-link" href="admin_nilaiDev.php">
              <i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Nilai Developer</span>
            </a>
          </li>

          <li class="sidebar-item ">
            <a class="sidebar-link" href="admin_user.php">
              <i class="align-middle" data-feather="user"></i> <span class="align-middle">Data User</span>
            </a>
          </li>

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

          <h1 class="h3 mb-3">Isi Nilai Developer</h1>

          <div class="row">

            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-center">Proses Perangkingan Developer</h3>
                  <hr>
                </div>
                <div class="table-responsive">
                  <table class="table mb-0 table table-bordered border-primary">
                    <thead class="text-center">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col" class="text-start">DEVELOPER</th>
                        <th scope="col">LEARNABILITY</th>
                        <th scope="col">EFICIENCY</th>
                        <th scope="col">MEMORABILITY</th>
                        <th scope="col">ERROR</th>
                        <th scope="col">SATISFACTION</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      <?php foreach ($data_user as $du) : ?>
                        <tr>
                          <td>
                            <center><?= $no; ?></center>
                          </td>
                          <td><?= $du["nama"]; ?></td>
                          <td>
                            <select name="learnbility" class="form-control">
                              <option value="1">Sangat Rendah</option>
                              <option value="2">Rendah</option>
                              <option value="3">Sedang</option>
                              <option value="4">Tinggi</option>
                              <option value="5">Sangat Tinggi</option>
                            </select>
                          </td>
                          <td>
                            <select name="jurusan" class="form-control">
                              <option value="1">Sangat Rendah</option>
                              <option value="2">Rendah</option>
                              <option value="3">Sedang</option>
                              <option value="4">Tinggi</option>
                              <option value="5">Sangat Tinggi</option>
                            </select>
                          </td>
                          <td>
                            <select name="jurusan" class="form-control">
                              <option value="1">Sangat Rendah</option>
                              <option value="2">Rendah</option>
                              <option value="3">Sedang</option>
                              <option value="4">Tinggi</option>
                              <option value="5">Sangat Tinggi</option>
                            </select>
                          </td>
                          <td>
                            <select name="jurusan" class="form-control">
                              <option value="1">Sangat Rendah</option>
                              <option value="2">Rendah</option>
                              <option value="3">Sedang</option>
                              <option value="4">Tinggi</option>
                              <option value="5">Sangat Tinggi</option>
                            </select>
                          </td>
                          <td>
                            <select name="jurusan" class="form-control">
                              <option value="1">Sangat Rendah</option>
                              <option value="2">Rendah</option>
                              <option value="3">Sedang</option>
                              <option value="4">Tinggi</option>
                              <option value="5">Sangat Tinggi</option>
                            </select>
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

        <div class="jutify-content-center text-center mb-3">
          <button type="button" class="btn btn-outline-primary btn-lg" name="update">
            UPDATE SAW
          </button>
          <button type="button" class="btn btn-outline-success btn-lg" name="proses">
            SAW PROSES
          </button>
        </div>

        <div class="col-12">
          <div class="card">
            <div class="table-responsive">
              <table class="table mb-0 table table-bordered border-primary">
                <thead class="text-center">
                  <tr>
                    <th scope="col">No</th>
                    <th scope="col" class="text-start">DEVELOPER</th>
                    <th scope="col">LEARNABILITY</th>
                    <th scope="col">EFICIENCY</th>
                    <th scope="col">MEMORABILITY</th>
                    <th scope="col">ERROR</th>
                    <th scope="col">SATISFACTION</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $no = 1; ?>
                  <?php foreach ($data_user as $du) : ?>
                    <tr>
                      <td>
                        <center><?= $no; ?></center>
                      </td>
                      <td><?= $du["nama"]; ?></td>
                      <?php
                      $nilai = $saw->get_data_nilai_id($du['id_users']);
                      while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) { ?>
                        <td>
                          <center><?php echo $data_nilai['nilai']; ?></center>
                        </td>
                      <?php } ?>
                      </td>
                    </tr>
                    <?php $no++ ?>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>

          <div class="row">
            <h3 class="h3 mb-3">Pembobotan</h3>
            <div class="col-12">
              <div class="card">
                <div class="table-responsive">
                  <table class="table mb-0 table table-bordered border-primary">
                    <thead class="text-center">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col" class="text-start">DEVELOPER</th>
                        <th scope="col">LEARNABILITY</th>
                        <th scope="col">EFICIENCY</th>
                        <th scope="col">MEMORABILITY</th>
                        <th scope="col">ERROR</th>
                        <th scope="col">SATISFACTION</th>
                        <th scope="col">Hasil</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      <?php foreach ($data_user as $du) : ?>
                        <tr>
                          <td>
                            <center><?= $no; ?></center>
                          </td>
                          <td><?= $du["nama"]; ?></td>
                          <?php
                          $developer = $saw->get_data_developer();
                          while ($data_developer = $developer->fetch(PDO::FETCH_ASSOC)) {
                          ?>
                            <?php
                            // tampilkan nilai dengan id_developer ...
                            $hasil_normalisasi = 0;
                            $nilai = $saw->get_data_nilai_id($data_developer['id_users']);
                            while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
                              //
                              $kriteria = $saw->get_data_kriteria_id($data_nilai['id_kriteria']);
                              while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
                                $min = $saw->nilai_min($data_nilai['id_kriteria']);
                                while ($data_min = $min->fetch(PDO::FETCH_ASSOC)) { ?>
                                  <td>
                                    <center>
                                      <?php
                                      number_format($hasil = $data_min['min'] / $data_nilai['nilai'], 2);
                                      echo  $hasil_kali = $hasil * $data_kriteria['bobot'];
                                      $hasil_normalisasi = $hasil_normalisasi + $hasil_kali;
                                      ?>
                                    </center>
                                  </td>
                                <?php }
                                ?>

                            <?php }
                            } ?>
                            <td>
                              <center>
                                <?php
                                $hasil_rank['nilai'] = $hasil_normalisasi;
                                $hasil_rank['developer'] = $data_developer['nama'];
                                array_push($hasil_ranks, $hasil_rank);
                                echo $hasil_normalisasi; ?>
                                </<center>
                            </td>
                          <?php } ?>
                        </tr>
                        <?php $no++ ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>

          <div class="row">
            <h3 class="h3 mb-3">Normalisasi</h3>
            <div class="col-12">
              <div class="card">
                <div class="table-responsive">
                  <table class="table mb-0 table table-bordered border-primary">
                    <thead class="text-center">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col" class="text-start">DEVELOPER</th>
                        <th scope="col">LEARNABILITY</th>
                        <th scope="col">EFICIENCY</th>
                        <th scope="col">MEMORABILITY</th>
                        <th scope="col">ERROR</th>
                        <th scope="col">SATISFACTION</th>
                        <th scope="col">Hasil</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      <?php foreach ($data_user as $du) : ?>
                        <tr>
                          <td>
                            <center><?= $no; ?></center>
                          </td>
                          <td><?= $du["nama"]; ?></td>
                        </tr>
                        <?php
                        $developer = $saw->get_data_developer();
                        while ($data_developer = $developer->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                          <tr>
                            <?php
                            // tampilkan nilai dengan nama_developer
                            $hasil_normalisasi = 0;
                            $nilai = $saw->get_data_nilai_id($data_developer['id_users']);
                            while ($data_nilai = $nilai->fetch(PDO::FETCH_ASSOC)) {
                              //
                              $kriteria = $saw->get_data_kriteria_id($data_nilai['id_kriteria']);
                              while ($data_kriteria = $kriteria->fetch(PDO::FETCH_ASSOC)) {
                                if ($data_kriteria['jenis'] == "cost") {
                                  $min = $saw->nilai_min($data_nilai['id_kriteria']);
                                  while ($data_min = $min->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <td>
                                      <center>
                                        <?php
                                        echo number_format($hasil = $data_min['min'] / $data_nilai['nilai'], 2);
                                        $hasil_kali = $hasil * $data_kriteria['bobot'];
                                        $hasil_normalisasi = $hasil_normalisasi + $hasil_kali;
                                        ?>
                                      </center>
                                    </td>
                                  <?php } ?>

                                  <?php } elseif ($data_kriteria['jenis'] == "benefit") {
                                  $max = $saw->nilai_max($data_nilai['id_kriteria']);
                                  while ($data_max = $max->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <td>
                                      <center>
                                        <?php
                                        echo $hasil = $data_nilai['nilai'] / $data_max['max'];
                                        $hasil_kali = $hasil * $data_kriteria['bobot'];
                                        $hasil_normalisasi = $hasil_normalisasi + $hasil_kali;
                                        ?>
                                      </center>
                                    </td>
                                  <?php } ?>
                                <?php }
                                ?>

                            <?php }
                            } ?>
                          </tr>
                        <?php } ?>
                        </tr>
                        <?php $no++ ?>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>



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