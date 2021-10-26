<?php

require 'connection.php';

_cookie();

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load PHP Mailer
require 'asset/PHPMailer/src/Exception.php';
require 'asset/PHPMailer/src/OAuth.php';
require 'asset/PHPMailer/src/PHPMailer.php';
require 'asset/PHPMailer/src/POP3.php';
require 'asset/PHPMailer/src/SMTP.php';



// JIKA SUDAH LOGIN MASUKKAN KEDALAM INDEX
if (isset($_SESSION["None"])) {
  header('location: index.php');
  exit;
} elseif (isset($_SESSION["Developer"])) {
  header('location: developer_dashboard.php');
  exit;
} elseif (isset($_SESSION["Admin"])) {
  header('location: admin_Dashboard.php');
  exit;
}
?>


<?php
// APABILA TOMBOL CONFIRM DITEKAN
if (isset($_POST["register"])) {
  if (_register($_POST) > 0) {

    global $con;
    $emailTo = $_POST["email"];

    $hasil = mysqli_query($con, "SELECT * FROM tb_users WHERE email = '$emailTo' ");

    if (mysqli_num_rows($hasil) === 1) {

      $pass = mysqli_fetch_assoc($hasil);
      $kode = uniqid();

      //Instantiation and passing `true` enables exceptions
      $mail = new PHPMailer(true);

      try {
        $mail->SMTPDebug = 0;
        $mail->isSMTP();
        //Server settings
        $mail->isSMTP();                                          //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                 //Enable SMTP authentication
        $mail->Username   = 'keamanan.perangakat@gmail.com';     //SMTP username
        $mail->Password   = 'potensi081';               //SMTP password
        $mail->SMTPSecure = 'ssl';                                //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 465;                                  //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom('keamanan.perangakat@gmail.com', 'SPK');
        $mail->addAddress($emailTo);                     //Add a recipient
        $mail->addReplyTo('no-reply@gmail.com', 'No Reply');

        //Content
        $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/registerVerif.php?kode=$kode&email=$emailTo";
        $mail->isHTML(true);                              //Set email format to HTML
        $mail->Subject = 'Verifikasi Akun KPL';
        $mail->Body    = "<h1>Silahkan klik link dibawah ini untuk verifikasi akun</h1><br>
                  Klik<a href='$url'> Link Berikut </a>untuk memverifikasi";
        $mail->AltBody = 'Welcome to our site.';

        $mail->send();
      } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }

    echo "<script>
    alert ('Silahkan lakukan verifikasi yang telah dikirimkan ke email anda.');
     document.location.href = 'https://mail.google.com/';
      </script>";
  } else {
    echo mysqli_error($con);
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <!-- Style Bootstrap -->
  <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.css">
  <!-- Style Css -->
  <link rel="stylesheet" href="asset/style/login.css">


</head>

<body>

  <main class="form-signin">
    <h1 class="h3 mb-3 fw-normal text-center">Regisratrasi Untuk Login</h1>

    <form action="register.php" method="POST">

      <div class="form-floating">
        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required minlength="5" maxlength="50">
        <label for="floatingInput">Full Name</label>
      </div>

      <div class="form-floating">
        <input type="text" class="form-control" id="username" name="username" placeholder="username" required minlength="5" maxlength="50">
        <label for="floatingInput">Username</label>
      </div>

      <div class="form-floating">
        <input type="email" class="form-control" placeholder="name@example.com" id="email" name="email" placeholder="email.example@gmail.com" required minlength="5" maxlength="50">
        <label for="floatingInput">Email address</label>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" placeholder="Password" id="password" name="password" required minlength="3" maxlength="30">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" placeholder="Password" id="password2" name="password2" required minlength="3" maxlength="30">
        <label for="floatingPassword">Konfirmasi Password</label>
      </div>

      <button class="w-100 btn btn-lg btn-primary" type="submit" id="register" name="register">Register</button>
      <small class="d-block text-center mt-3">Already Registered? <a href="login.php">Login</a></small>
    </form>
  </main>

  <!-- Popper Script-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <!-- Bootstrap Script -->
  <script src="asset/bootstrap/js/bootstrap.js"></script>

</body>

</html>