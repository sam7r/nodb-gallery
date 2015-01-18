<?php


if(!isset($album) || in_array($gallery->getAlbumName(), $gallery->directory)) {

	if(isset($album)) {

		$name = $gallery->getAlbumName();

	}

	foreach($gallery->getAlbum() as $image) {

		if(is_dir($gallery->dir . $image)) {

			$albumName = $image;

			$albumLink = $_SERVER['PHP_SELF'];

			if(isset($album)) {

				$albumLink .= "?a=" . urlencode($_GET['a'] . '/' . $image);

			} else {

				$albumLink .= "?a=" . urlencode($image);

			}

			//--------------------

			// ** Album sub directories **

			// HTML output for folders - change to display image or
			// folder icon with album name etc...

			//--------------------

			?>


			<a href="<?php echo $albumLink; ?>" class="folder col1-4"><?php echo $albumName; ?></a>


			<?php

			//--------------------

		} else {

			$imageLink = $gallery->dir .''. $image;

			$imageThumb = $gallery->thumbDir .''. $gallery->thumbPfx .''. $image;

			//--------------------

			// ** Album Images **

			// HTML output for image, the image thumb is used as a placeholder
			// this example uses lightbox to open the full sized image onClick.

			//--------------------

			?>


			<a class="fancybox image col1-4" rel="group" href="<?php echo $imageLink; ?>">

				<img src="<?php echo $imageThumb; ?>" alt="Kent Valeting Services" />

			</a>


			<?php

			//--------------------

		}

	}

}


?>
