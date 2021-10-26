<?php
require 'connection.php';

// set cookies
_cookie();

// loogin
_login();

// set session
if (isset($_SESSION["None"])) {
  header('location: index.php');
  exit;
} elseif (isset($_SESSION["Developer"])) {
  header('location: developer_dashboard.php');
  exit;
} elseif (isset($_SESSION["Admin"])) {
  header('location: admin_dashboard.php');
  exit;
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
    <h1 class="h3 mb-3 fw-normal text-center">Login Untuk Masuk</h1>

    <form action="login.php" method="POST">

      <div class="form-floating">
        <input type="email" class="form-control" id="email" name="email" placeholder="email.example@gmail.com" required minlength="5" maxlength="50">
        <label for="floatingInput">Email address</label>
      </div>

      <div class="form-floating">
        <input type="password" class="form-control" placeholder="Password" id="password" name="password" required minlength="3" maxlength="30">
        <label for="floatingPassword">Password</label>
      </div>
      <small class="d-block text-center mt-3">Forgot Password ? <a href="forgot.php">Forgot Password</a></small>
      <button class="w-100 btn btn-lg btn-primary" type="submit" id="login" name="login">Login</button>
      <small class="d-block text-center mt-3">Not Registered ? <a href="register.php">Register Now!</a></small>
    </form>
  </main>

  <!-- Popper Script-->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <!-- Bootstrap Script -->
  <script src="asset/bootstrap/js/bootstrap.js"></script>

</body>

</html>