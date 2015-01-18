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

	<section class="sec b1">

		<div class="wrap">

			<h1>NoDb Gallery</h1>


			<div class="btn-nav back">

				<a href="<?php echo backDir(); ?>" <?php if($gallery->getAlbumName()) { ?> disabled <?php } ?>>Back</a>

			</div>


			<!-- Gallery -->

			<main class="col-1 gallery">

				<?php include "inc/gallery.php"; ?>

			</main>


			<!-- Gallery nav -->

			<div class="gallery-nav">

				<div class="btn-nav">

					<a href="<?php echo backBtn($gallery->page); ?>"><</a>

				</div>

				<div class="pagi">

					<?php echo pagiNum($gallery->page, $gallery->pageCount()); ?>

				</div>

				<div class="btn-nav">

					<a href="<?php echo nextBtn($gallery->page, $gallery->pageCount()); ?>">></a>

				</div>

			</div>




		</div>

	</section>


	<footer class="sec foot">


	</footer>


</body>
