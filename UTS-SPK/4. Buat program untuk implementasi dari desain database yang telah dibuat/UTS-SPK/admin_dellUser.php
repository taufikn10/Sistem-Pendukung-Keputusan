<?php

require 'connection.php';

// set cookies
_cookie();

// set session
if (!isset($_SESSION["Admin"])) {
	header('location: login.php');
	exit;
}

?>

<?php
//tangkap id yang di tekan
$id = $_GET["id_users"];

if (delete_user($id) > 0) {
	echo " 
			<script>
				alert ('data berhasil dihapus !');
				document.location.href = 'admin_user.php';
			</script>
		";
} else {
	echo " 
			<script>
				alert ('data gagal dihapus !');
				document.location.href = 'admin_user.php';
			</script>
		";
}

?>