<?php 

require 'connection.php';

if (!isset($_GET["kode"])) {
  echo "<script>
  alert( 'Tidak Dapat Mencari Halaman' );
  document.location.href = 'login.php';
  </script>";
}

$kode = $_GET["kode"];

$getKode = mysqli_query($con, "SELECT * FROM tb_resetpass WHERE kode='$kode'");

if (mysqli_num_rows($getKode) === 0) {
  echo "<script>
  alert( 'Tidak Dapat Mencari Halaman' );
  document.location.href = 'login.php';
  </script>";
}
?>

<?php
if (isset($_POST["forgot"])) {
  // apakah password berhasil dibah atau tidak
  if (_forgot_pass($_POST) > 0) {
    echo "<script>
    alert( 'Pembaruan Password Sukses !!' );
    document.location.href = 'login.php';
    </script>";
  } else {
    echo "<script>
    alert( 'Password Tidak Cocok harap ulangi Lagi' );
    document.location.href = 'updatepass.php?kode=".$kode." ';
    </script>";
  }
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Password</title>
  <!-- Style Bootstrap -->
  <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.css">
  <!-- Style Css -->
  <link rel="stylesheet" href="asset/style/forgot.css?v=<?php echo time(); ?>">
</head>
<body>

    <!-- forgot -->
    <div class="container padding-bottom-3x mb-2 mt-5">
    <div class="row justify-content-center">
      <div class="col-lg-8 col-md-10">

      <form class="card mt-4" action="" method="POST" enctype="multipart/form-data">
          <div class="card-body">

          <h3 class="text-center">Memperbarui Password</h3>

            <div class="form-group"> 
              <label for="otp" class="mt-2">Kode OTP</label> 
              <input 
              class="form-control" 
              type="text" 
              id="otp" 
              name="otp" 
              required
              autocomplete="off" 
              placeholder="Kode - OTP"
              >
            </div>

            <div class="form-group"> 
              <label for="new_pass" class="mt-2">Masukkan Password Baru</label> 
              <input 
              class="form-control" 
              type="password" 
              id="new_pass" 
              name="new_pass" 
              required 
              autocomplete="off" 
              placeholder="Password Baru"
              >
            </div>
            
            <div class="form-group"> 
              <label for="new_pass2" class="mt-2">Konfirmasi Password Baru</label> 
              <input 
              class="form-control" 
              type="password" 
              id="new_pass2"
              name="new_pass2" 
              required 
              autocomplete="off" 
              placeholder="Konfirmasi Password Baru">
            </div>

          <div class="card-footer text-center">
            <input class="btn btn-success mt-2" type="submit" name="forgot" value="Perbarui Password">
          </div>

        </form>
      </div>
    </div>
  </div>


  <!-- Popper Script-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <!-- Bootstrap Script -->
  <script src="asset/bootstrap/js/bootstrap.js"></script>
  <!-- javascript -->
</body>
</html>