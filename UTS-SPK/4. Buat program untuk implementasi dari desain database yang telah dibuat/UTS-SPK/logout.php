<?php

session_start();
$_SESSION = [];
session_unset();
session_destroy();

setcookie('id_users', '', time() - 3600, '/');
setcookie('no', '', time() - 3600, '/');

header("Location: login.php");
exit;


?>