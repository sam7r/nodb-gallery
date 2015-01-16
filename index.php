<?php


require "class/gallery.php"; // Gallery class


//--------------------

// object setup

//--------------------


$dir = 'images/folio/';

$gallery = new Gallery($dir);

$gallery->limit = 12; // (optional: default is 8)

if(isset($_GET['a'])) {

	$gallery->dir = $gallery->dir . '' . urldecode($_GET['a']) . '/';

}

$gallery->setAlbum();

$page = $gallery->page;

$pageCount = $gallery->pageCount();


require "inc/gallery-pagination.php";


?>
<!DOCTYPE html>
<head>

	<title>NoDb Gallery</title>

</head>

<body>

	<?php

	echo backDir();

	if(!isset($_GET['a']) || in_array($gallery->getAlbumName(), $gallery->directory)) {

		if(isset($_GET['a'])) {

			$name = $gallery->getAlbumName();

		}

		foreach($gallery->getAlbum() as $image) {

			if(is_dir($gallery->dir . $image)) {

				$albumName = $image;

				$albumLink = $_SERVER['PHP_SELF'];

				if(isset($_GET['a'])) {

					$albumLink .= "?a=" . urlencode($_GET['a'] . '/' . $image);

				} else {

					$albumLink .= "?a=" . urlencode($image);

				}

				?>




				<a href="<?php echo $albumLink; ?>" class="folder col1-4"><?php echo $albumName; ?></a>




				<?php

			} else {

				$imageLink = $gallery->dir .''. $image;

				$imageThumb = $gallery->thumbDir .''. $gallery->thumbPfx .''. $image;

				?>




				<a class="fancybox image col1-4" rel="group" href="<?php echo $imageLink; ?>">

					<img src="<?php echo $imageThumb; ?>" alt="Kent Valeting Services" />

				</a>




				<?php

			}

		}




		echo backBtn();

		echo pagiNum();

		echo nextBtn();



	}

	?>


</body>
