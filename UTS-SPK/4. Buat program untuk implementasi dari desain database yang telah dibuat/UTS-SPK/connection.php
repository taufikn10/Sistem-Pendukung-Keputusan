<?php

// mengkoneksikan ke database
$con = mysqli_connect("localhost", "root", "", "uts_spk");
if (mysqli_connect_errno()) {
    echo mysqli_connect_error();
}

//time
date_default_timezone_set('Asia/Jakarta');

// session
session_start();


// registrasi
function _register($data)
{
    global $con;

    $nama = ucwords(stripslashes($data["nama"]));
    $username = strtolower(stripslashes($data["username"]));
    $email = strtolower(stripcslashes($data["email"]));
    $password = mysqli_real_escape_string($con, $data["password"]);
    $password2 = mysqli_real_escape_string($con, $data["password2"]);

    // usernname
    $hasil = mysqli_query($con, "SELECT username FROM tb_users WHERE username = '$username' ");

    // username
    if (mysqli_fetch_assoc($hasil)) {
        echo "<script>
      alert('Username Sudah Ada! gunakan username yang belum ada!');
      </script>";
        return false;
    }

    // email
    $hasil = mysqli_query($con, "SELECT email FROM tb_users WHERE email = '$email' ");

    // email
    if (mysqli_fetch_assoc($hasil)) {
        echo "<script>
      alert('Email Sudah Ada! gunakan email yang belum ada!');
      </script>";
        return false;
    }

    // confirm password
    if ($password != $password2) {
        echo " <script> 
      alert('konfirmasi password tidak sesuai!');
      </script>";
        return false;
    }

    // enkripsi password
    $pass = password_hash($password2, PASSWORD_DEFAULT);

    // menambahkan user
    mysqli_query($con, "INSERT INTO tb_users VALUES('', '',  '$username', '$nama',  '$email', '$pass', '' , 0, 'None')");

    return mysqli_affected_rows($con);
}

// cookie
function _cookie()
{
    global $con;
    // cookie set
    if (isset($_COOKIE['id_users']) && isset($_COOKIE['no'])) {
        $id_users = $_COOKIE['id_users'];
        $no = $_COOKIE['no'];

        // ambil emaile bedasarkan id
        $hasil = mysqli_query($con, "SELECT * FROM tb_users WHERE id_users = $id_users");
        $pass = mysqli_fetch_assoc($hasil);

        // cek cookie dan email
        if ($no === hash('sha256', $pass['email'])) {
            if ($pass['level'] == 'None') {
                $_SESSION['None'] = true;
            } elseif ($pass['level'] == "Developer") {
                $_SESSION['Developer'] = true;
            } elseif ($pass['level'] == "Admin") {
                $_SESSION['Admin'] = true;
            }
        }
    }
}

// login
function _login()
{

    if (isset($_POST["login"])) {
        try {
            global $con;

            $email = $_POST["email"];
            $password = $_POST["password"];

            $hasil = mysqli_query($con, "SELECT * FROM tb_users WHERE email = '$email' ") or die(mysqli_error($con));

            //cek username
            if (mysqli_num_rows($hasil) === 1) {

                // pencocokan password 
                $pass = mysqli_fetch_assoc($hasil);

                if (password_verify($password, $pass["password"])) {

                    if ($pass["verifikasi"] == "1") {

                        // set session user
                        $_SESSION["id_users"] = $pass["id_users"];

                        if ($pass["level"] == "None") {
                            // set None
                            $_SESSION["None"] = true;

                            // Cek Remember
                            if (isset($_POST['remember'])) {
                                // Buat Cookie
                                setcookie('id_users', $pass['id_users'], time() + 6000, '/');
                                setcookie('no', hash('sha256', $pass['email']), time() + 6000, '/');
                            }
                            header('location: index.php');
                        } else if ($pass["level"] == "Developer") {
                            // sesiion Developer
                            $_SESSION["Developer"] = true;

                            // Cek Remember
                            if (isset($_POST['remember'])) {
                                // Buat Cookie
                                setcookie('id_users', $pass['id_users'], time() + 6000, '/');
                                setcookie('no', hash('sha256', $pass['email']), time() + 6000, '/');
                            }
                            header('location: developer_dashboard.php');
                        } else if ($pass["level"] == "Admin") {
                            // session Admin
                            $_SESSION["Admin"] = true;

                            // Cek Remember
                            if (isset($_POST['remember'])) {
                                // Buat Cookie
                                setcookie('id_users', $pass['id_users'], time() + 6000, '/');
                                setcookie('no', hash('sha256', $pass['email']), time() + 6000, '/');
                            }
                            header('location: admin_dashboard.php');
                        } else {
                            throw new Exception("Akun Tidak Terdaftar Silahkan Melakukan Registrasi");
                        }
                    } else {
                        throw new Exception("Anda Belum Meverifikasi Akun Cek Email dan Login Kembali");
                    }
                } else {
                    throw new Exception("Password Salah Silahkan Ulangi lagi");
                }
            } else {
                throw new Exception("Email Tidak Terdaftar Silahkan Melakukan Registrasi");
            }
            exit;
        } catch (Exception $error) {
            echo "<script>
        alert ('" . $error->getMessage() . "');
            document.location.href = 'login.php';
        </script>";
        }
    }
}


// Lupa Password
function _forgot_pass($data)
{
    global $con;

    $otp = mysqli_real_escape_string($con, $data["otp"]);
    $new_pass = mysqli_real_escape_string($con, $data["new_pass"]);
    $new_pass2 = mysqli_real_escape_string($con, $data["new_pass2"]);

    $hasil = mysqli_query($con, "SELECT * FROM tb_resetpass WHERE otp = '$otp' ");

    // pencocokan Otp
    if (mysqli_num_rows($hasil) === 0) {
        echo "<script>
		alert('OTP Salah silahkan ulangi Lagi');
		</script>";

        return false;
    }

    // Pencocokan Password
    $row = mysqli_fetch_assoc($hasil);
    if ($new_pass !== $new_pass2) {
        echo "<script>
		alert('Konfirmasi password salah');
		</script>";

        return false;
    }

    // mengengkripsi password
    $newPass = password_hash($new_pass2, PASSWORD_DEFAULT);

    // QUERY
    $query_hapus = "DELETE FROM tb_resetpass WHERE otp = '$otp' ";
    mysqli_query($con, $query_hapus) or die(mysqli_error($con));

    $query_update = "UPDATE tb_users SET password = '$newPass' WHERE id_users = '" . $row["id_users"] . "' ";
    mysqli_query($con, $query_update) or die(mysqli_error($con));

    // mengembalikan nilai true atau false
    return mysqli_affected_rows($con);
}


// verikasi email
function _verifikasi_email($email)
{
    global $con;

    //query update data tb_user
    $query_update = "UPDATE tb_users SET verifikasi = '1' WHERE email = '$email' ";
    mysqli_query($con, $query_update) or die(mysqli_error($con));

    return mysqli_affected_rows($con);
}



// show data
function lihat($query)
{
    global $con;

    $hasil = mysqli_query($con, $query) or die(mysqli_error($con));
    $notif = [];

    // arry
    while ($notief = mysqli_fetch_assoc($hasil)) {
        $notif[] = $notief;
    }
    return $notif;
}

//session kedaluarsa
function _timeout()
{
    $waktuhabis = 2;

    $_SESSION['session_mulai'] = time();

    $waktuhabis = $waktuhabis * 60;
    if (isset($_SESSION['session_mulai'])) {
        $setting = time() - $_SESSION['session_mulai'];
        if ($setting >= $waktuhabis) {
            session_destroy();
            header("Location: login.php");
        }
    }
}

// MMEBUAT DELETE USER
function delete_user($id)
{
    global $con;

    // QUERY DELETE DATA
    $query = "DELETE FROM tb_users WHERE id_users = '$id' ";

    mysqli_query($con, $query) or die(mysqli_error($con));

    // MENGEMBALIKAN NILAI BERUPA "-1"(false) atau "1"(true)
    return mysqli_affected_rows($con);
}



// class Saw
// {
//     private $db;
//     function __construct()
//     {
//         $this->db = new PDO('mysql:host=localhost;dbname=uts_spk', "root", "");
//     }

//     public function get_data_kriteria()
//     {
//         $stmt = $this->db->prepare("SELECT*FROM tb_kriteria ORDER BY id_kriteria");
//         $stmt->execute();
//         return $stmt;
//     }

//     public function get_data_developer()
//     {
//         $stmt = $this->db->prepare("SELECT*FROM tb_users ORDER BY id_users");
//         $stmt->execute();
//         return $stmt;
//     }

//     public function get_data_kriteria_id($id)
//     {
//         $stmt = $this->db->prepare("SELECT*FROM tb_kriteria WHERE id_kriteria='$id' ORDER BY id_kriteria");
//         $stmt->execute();
//         return $stmt;
//     }

//     public function get_data_nilai_id($id)
//     {
//         $stmt = $this->db->prepare("SELECT * FROM tb_nilai WHERE id_users='$id' ORDER BY id_users");
//         $stmt->execute();
//         return $stmt;
//     }


//     public function nilai_max($id)
//     {
//         $stmt = $this->db->prepare("SELECT id_kriteria, MAX(nilai) AS max FROM tb_nilai WHERE id_kriteria='$id' GROUP BY id_kriteria");
//         $stmt->execute();
//         return $stmt;
//     }

//     public function nilai_min($id)
//     {
//         $stmt = $this->db->prepare("SELECT id_kriteria, MIN(nilai) AS min FROM tb_nilai WHERE id_kriteria='$id' GROUP BY id_kriteria");
//         $stmt->execute();
//         return $stmt;
//     }
// }
