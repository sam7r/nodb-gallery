<?php

ini_set('display_errors', '1');

// Sets up Gallery class (defines options)
// Adds functions for navigation of gallery
include "inc/gallery-config.php";

?>

<!DOCTYPE html>

<head>

	<title>NoDb Gallery</title>

	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,500,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" type="text/css" href="/css/style.css" />

</head>

<body>

	<header class="sec b3">

		<div class="wrap">

			<h1>NoDb Gallery</h1>

		</div>

	</header>

	<section class="sec b1">

		<div class="wrap">


			<!-- Gallery -->

			<main class="col2-3 col-1m gallery">

				<?php include "inc/gallery.php"; ?>

			</main>

			
			<!-- Gallery nav -->

			<div class="col1-3 col-1m gallery-nav">

				<?php include "inc/gallery-nav.php"; ?>

			</div>


		</div>

	</section>


	<footer class="sec foot b3">


	</footer>


</body>
