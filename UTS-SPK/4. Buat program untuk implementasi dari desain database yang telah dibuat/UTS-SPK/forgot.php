<?php 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'asset/PHPMailer/src/Exception.php';
require 'asset/PHPMailer/src/OAuth.php';
require 'asset/PHPMailer/src/PHPMailer.php';
require 'asset/PHPMailer/src/POP3.php';
require 'asset/PHPMailer/src/SMTP.php';

// koneksi mhs
require 'connection.php';

// Menghubungkan Ke database
if (isset($_POST["email"])) {

  global $con;
  $emailTo = $_POST["email"];

  $result = mysqli_query($con, "SELECT * FROM tb_users WHERE email = '$emailTo' ");
  
  if (mysqli_num_rows ($result) === 1) {

    $row = mysqli_fetch_assoc($result);  
    $kode = uniqid();
    $otp = mt_rand(100000, 999999);

    // BUAT KODE OTP UNTUK VERIFIKASI
    $query = "INSERT INTO tb_resetpass(kode, otp,  id_users) VALUES('$kode', '$otp' , '".$row['id_users']."')";
    mysqli_query($con, $query) or die(mysqli_error($con));


    //Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'keamanan.perangakat@gmail.com';                     //SMTP username
    $mail->Password   = 'potensi081';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;                                  //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 465;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('keamanan.perangakat@gmail.com', 'KPL');
    $mail->addAddress($emailTo);     //Add a recipient
    $mail->addReplyTo('no-reply@gmail.com', 'No Reply');

    //Content
    $url = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/updatepass.php?kode=$kode";
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Memperbarui Password dari KPL';
    $mail->Body    = "<h2>Memperbarui Password</h2><br>
    <h3>Kode OTP : ".$otp."</h3>
    Klik <a href='$url'>Link Berikut</a> untuk memperbarui ";
    $mail->AltBody = 'Thankyou.';

    $mail->send();
    echo "<script>
    alert ('Reset Password link has been sent to your email');
    document.location.href = 'login.php';
    </script>";
  } 
  catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
  }
}
else {
    echo "<script>
    alert ('Email yang anda masukkan tidak terdaftar !');
    document.location.href = 'forgot.php';
    </script>";
}
exit();
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lupa Password</title>
    <!-- Style Bootstrap -->
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.css">
    <!-- Style Css -->
    <link rel="stylesheet" href="asset/style/forgot.css">
</head>

<body>
<!-- forgot -->
<div class="container padding-bottom-3x mb-2 mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <div class="forgot">
        <h2>Lupa Password?</h2>
        <p>Ubah kata sandi anda dalam tiga langkah. Ini akan membantu anda mengamankan kata sandi terbaru anda!</p>
        <ol class="list-unstyled">
          <li><span class="text-primary text-medium">1. </span>Masukkan Email anda di bawah ini.</li>
          <li><span class="text-primary text-medium">2. </span>Sistem kami akan memberikan link ke email anda</li>
          <li><span class="text-primary text-medium">3. </span>Gunakan kode OTP dan link untuk mereset password</li>
        </ol>
      </div>
      
      <form class="card mt-4" method="POST" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group"> 
            <label for="email-for-pass">Enter your email address</label> 
          <input 
          class="form-control" 
          type="email" 
          id="email-for-pass" 
          required
          autocomplete="off" 
          placeholder="email.example@gmail.com"
          name="email">
          <small class="form-text text-muted">
          Masukkan alamat email yang Anda gunakan saat pendaftaran di Kemudian kami akan mengirim email tautan ke alamat ini. 
        </small> 
        </div>
        </div>
        <div class="card-footer text-center">
          <input class="btn btn-success" type="submit" name="submit" value="Reset Email">
          <a href="login.php" class="btn btn-back">Back Login</a>
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