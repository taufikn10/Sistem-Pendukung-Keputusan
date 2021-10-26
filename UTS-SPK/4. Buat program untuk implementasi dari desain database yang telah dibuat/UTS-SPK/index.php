<?php
require 'connection.php';

// set cookies
_cookie();

// set session
if (!isset($_SESSION["None"])) {
	header('location: login.php');
	exit;
} else {
	if (isset($_SESSION['id_users'])) {
		$id_users = $_SESSION['id_users'];
	} else {
		$id_users = $_COOKIE['id_users'];
	}
	// lihat
	$user = lihat("SELECT * FROM tb_users WHERE id_users = '$id_users' ")[0];
}
_timeout();

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>amazing section</title>

	<link rel="stylesheet" href="asset/bootstrap/css/bootstrap.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="asset/style/index.css?v=<?php echo time(); ?>">

</head>

<body>


	<section id="nav">
		<nav class="navbar navbar-light">
			<form class="container-fluid justify-content-start">
				<a href="logout.php" class="btn btn-logout me-2 mx-auto" onclick="return confirm('Yakin ingin Logout?')"><span>logout</span></a>
			</form>
		</nav>

		<section id="about">

			<div class="container">
				<div class="row">
					<div class="col-md-5">
						<div class="about-img">
							<img class="shape" src="asset/img/tringle.png" alt="">
						</div>
					</div>
					<br>
					<div class="col-md-6 about-right">

						<h2 class="color-3"><b>About Me</b>
						</h2>

						<p class="p-first text-white">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet nesciunt sint, esse iure eius voluptatibus perspiciatis sequi fuga magni perferendis beatae ratione, nam culpa veritatis dolore sunt ut minus qui Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum ea delectus doloremque adipisci autem deleniti non nostrum, suscipit soluta perferendis.
						</p>
						<p class="text-white">
							Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolores pariatur animi sunt, assumenda dicta distinctio nostrum nisi, ullam dignissimos dolor!
						</p>
						<h3 class="color-3 social-link-text">
							<button class="btn btn-danger">Hire Me</button>
						</h3>

						<ul class="about-link">
							<li><a href=""><i class="fa fa-fonticons"></i></a></li>

							<li><a href=""><i class="fa fa-envira"></i></a></li>


							<li><a href=""><i class="fa fa-reddit-alien"></i></a></li>


							<li><a href=""><i class="fa fa-dribbble"></i></a></li>


							<li><a href=""><i class="fa fa-youtube-play"></i></a></li>

						</ul>
					</div>

				</div>
			</div>

		</section>

</body>

</html>