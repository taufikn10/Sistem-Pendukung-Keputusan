<?php
// MENGHUBUNGKAN KONEKSI DATABASE
require "connection.php";

if (!isset($_GET["kode"])) {
    echo "<script>
        alert( 'Tidak Dapat Mencari Halaman' );
        document.location.href = 'login.php';
    </script>";
}

$kode = $_GET["kode"];
$email = $_GET["email"];

$getKode = mysqli_query($con, "SELECT * FROM tb_users WHERE email = '$email'");

if (mysqli_num_rows($getKode) === 0) {
    echo "<script>
        alert( 'Tidak Dapat Mencari Halaman' );
        document.location.href = 'login.php';
    </script>";
}

if (_verifikasi_email($email) > 0) {
    echo "<script>
        alert ('Email anda sudah terverifikasi !!');
        document.location.href = 'login.php';
    </script>";
} else {
    echo "<script>
        alert ('Error. Silahkan coba lagi !!');
        document.location.href = 'login.php';
    </script>";
}
?>