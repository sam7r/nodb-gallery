<?php

//========================================

// ** NoDb Gallery Output **

// Include this file in your html to loop through
// the selected album

//========================================

if($gallery->isValidDir() || !isset($album)) {

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

			// * Album sub directories *

			//--------------------

			?>

			<div class="col1-4 col1-3m col1-2s">

				<a href="<?php echo $albumLink; ?>" class="folder"><?php echo $albumName; ?></a>

			</div>


			<?php


		} else {

			$imageLink = $gallery->dir .''. $image;

			$imageThumb = $gallery->thumbDir .'/'. $gallery->thumbPfx .''. $image;

			//--------------------

			// * Album Images *

			//--------------------

			?>

			<div class="col1-4 col1-3m col1-2s">

				<a class="fancybox image" rel="group" href="<?php echo $imageLink; ?>">

					<img src="<?php echo $imageThumb; ?>" alt="Kent Valeting Services" />

				</a>

			</div>


			<?php

		}

	}

}


?>
