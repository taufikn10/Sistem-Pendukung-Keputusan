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
//QUERY :
$data_user = lihat("SELECT * FROM tb_users WHERE level = 'Developer'");

//Buat array bobot { C1 = 100; C2 = 80; C3 = 70; C4 = 90 dan C5 = 100}
$bobot = array(100, 80, 70, 90, 100);

//Buat fungsi tampilkan nama
function getNama($id)
{
  global $con;
  $q = mysqli_query($con, "SELECT * FROM tb_users where id_users = '$id'");
  $d = mysqli_fetch_array($q);
  return $d['nama'];
}


//Setelah bobot terbuat select semua di tabel Matrik
$sql = mysqli_query($con, "SELECT * FROM tb_matrik");

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

          <h1 class="h3 mb-3">Hasil Nilai Developer</h1>

          <div class="row">

            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-center">Tabel Keputusan</h3>
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
                        <th scope="col">Hasil</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php
                      $no = 1;
                      while ($dt = mysqli_fetch_array($sql)) {
                        $jumlah = ($dt['c1']) + ($dt['c2']) + ($dt['c3']) + ($dt['c4']) + ($dt['c5']);
                        echo "<tr>
                        <td> $no</td>
                        <td  class='text-start'>" . getNama($dt['id_users']) . "</td>
                        <td>$dt[c1]</td>
                        <td>$dt[c2]</td>
                        <td>$dt[c3]</td>
                        <td>$dt[c4]</td>
                        <td>$dt[c5]</td>
                        <td>$jumlah</td>
                        </tr>";
                        $no++;
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>

          <?php
          //Lakukan Normalisasi dengan rumus pada langkah 2
          //Cari Max atau min dari tiap kolom Matrik
          $crMax = mysqli_query($con, "SELECT max(c1) as maxK1,
          max(c2) as maxK2,
          max(c3) as maxK3,
          max(c4) as maxK4,
          max(c4) as maxK5
          FROM tb_matrik");
          $max = mysqli_fetch_array($crMax);

          //Hitung Normalisasi tiap Elemen
          $sql2 = mysqli_query($con, "SELECT * FROM tb_matrik");
          ?>

          <div class="row">

            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-center">Hasil Normalisasi Matriks</h3>
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
                    <tbody class="text-center">
                      <?php
                      $no = 1;
                      while ($dt2 = mysqli_fetch_array($sql2)) {
                        echo "<tr>
                        <td>$no</td>
                        <td class='text-start' >" . getNama($dt2['id_users']) . "</td>
                        <td>" . round($dt2['c1'] / $max['maxK1'], 2) . "</td>
                        <td>" . round($dt2['c2'] / $max['maxK2'], 2) . "</td>
                        <td>" . round($dt2['c3'] / $max['maxK3'], 2) . "</td>
                        <td>" . round($dt2['c4'] / $max['maxK4'], 2) . "</td>
                        <td>" . round($dt2['c5'] / $max['maxK5'], 2) . "</td>
                        </tr>";
                        $no++;
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>

          <?php
          //Proses perangkingan dengan rumus langkah 3
          $sql3 = mysqli_query($con, "SELECT * FROM tb_matrik");
          ?>

          <div class="row">

            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title text-center">Hasil Rangking</h3>
                  <hr>
                </div>
                <div class="table-responsive">
                  <table class="table mb-0 table table-bordered border-primary">
                    <thead class="text-center">
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col" class="text-start">DEVELOPER</th>
                        <th scope="col">Hasil</th>
                        <th scope="col">SAW</th>
                        <th scope="col">Keterangan</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                      <?php
                      //Kita gunakan rumus (Normalisasi x bobot)
                      while ($dt3 = mysqli_fetch_array($sql3)) {
                        $jumlah = ($dt3['c1']) + ($dt3['c2']) + ($dt3['c3']) + ($dt3['c4']) + ($dt3['c5']);
                        $poin = round(
                          (($dt3['c1'] / $max['maxK1']) * $bobot[0]) +
                            (($dt3['c2'] / $max['maxK2']) * $bobot[1]) +
                            (($dt3['c3'] / $max['maxK3']) * $bobot[2]) +
                            (($dt3['c4'] / $max['maxK4']) * $bobot[3]) +
                            (($dt3['c5'] / $max['maxK5']) * $bobot[4]),
                          3
                        );

                        $data[] = array(
                          'nama' => getNama($dt3['id_users']),
                          'jumlah' => $jumlah,
                          'poin' => $poin
                        );
                      }

                      //mengurutkan data
                      foreach ($data as $key => $isi) {
                        $nama[$key] = $isi['nama'];
                        $jlh[$key] = $isi['jumlah'];
                        $poin1[$key] = $isi['poin'];
                      }
                      array_multisort($poin1, SORT_DESC, $jlh, SORT_DESC, $data);
                      $no = 1;
                      $h = "peringkat";
                      $peringkat = 1;
                      $hr = 1;

                      foreach ($data as $item) { ?>
                        <tr>
                          <td><?php echo $no ?></td>
                          <td class="text-start"><?php echo $item['nama'] ?></td>
                          <td><?php echo $item['jumlah'] ?></td>
                          <td><?php echo $item['poin'] ?></td>
                          <td><?php echo "$h $peringkat" ?></td>
                        </tr>
                      <?php
                        $no++;
                        if ($no >= 10) {
                          $h = "  ";
                          $peringkat = " ";
                        } else {
                          $peringkat++;
                        }
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
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