<?php

ini_set('display_errors', 0);

// GALLERY CLASS
include "includes/gallery.php";

// SET ROOT OF GALLERY FOLDER
$dir = 'images/gallery/';

// SETUP OBJECT
$gallery = new Gallery($dir);

// SET MAX ITEMS PER PAGE (DEFAULT IS 8)
$gallery->maxImages = 12;

if(isset($_GET['a'])) {
	// OVERIDES OBJECT PATH TO DISPLAY CORRECT ALBUM IF WITHIN DIR FOLDER
	$gallery->dir = $gallery->dir . '' . urldecode($_GET['a']) . '/';
}

// SETS UP ALBUM TO DISPLAY
$gallery->setAlbum();

// CURRENT PAGE
$page = $gallery->page;

// PAGE TOTAL COUNT
$pageCount = $gallery->pageCount();

?>

<?php include "includes/header.php"; ?>

<?php include "includes/menu.php"; ?>

<?php include "includes/top-bar.php"; ?>

	<div class="section second">

		<div class="wrapper">

			<article class="col2-3">

				<h1>Gallery</h1>

			<?php if(!isset($_GET['a']) || isset($_GET['a']) && in_array($gallery->getAlbumName(), $gallery->directory)) {

				if(isset($_GET['a'])) { ?>

					<h2> <?php echo $gallery->getAlbumName() ?> </h2>

					<?php }

					// DISPLAYS IMAGES & SUB GALLERIES
					foreach($gallery->getAlbum() as $image) {

						// DISPLAYS DIRECTORIES
						if(is_dir($gallery->dir . $image)) { ?>

							<a class="gallery-image col1-4" href="<?php echo $_SERVER['PHP_SELF']; ?>

							<?php if(isset($_GET['a'])) { ?>

								?a=<?php echo urlencode($_GET['a'].'/'.$image); ?>">

							<?php } else { ?>

								?a=<?php echo urlencode($image); ?>">

							<?php } ?>

								<p class="album-name"><?php echo $image; ?></p><img src="images/icons/album-icon.png" />
							</a>

						<?php

						// DISPLAYS IMAGE THUMB WITH LINK TO IMAGE (LIGHTBOX)
						} else { ?>

							<a class="fancybox gallery-image col1-4" rel="group" href="<?php echo $gallery->dir .''. $image; ?>">

								<img src="<?php echo $gallery->thumbDir .''. $gallery->thumbPre .''. $image; ?>" alt="Kent Valeting Services" />

							</a>

						<?php }

					}

					// PAGINATION SCRIPTS FOR NAVIGATION
					include 'includes/gallery-pagination.php';

					?>

					<div class="pagination">

						<?php if(isset($_GET['a'])) { ?>

						<div class="button back-btn">

							<a href="<?php echo $backLink; ?>">
								<img src="images/icons/back-icon.png" alt="back icon"/>
							</a>

						</div>

						<?php } ?>

						<div class="back button <?php if($backBtnClass) { echo $backBtnClass; } ?>">

							<a href="<?php echo $backBtn; ?>"><</a>

						</div>

						<div class="pg-num">

							<?php foreach($pagination as $i => $link) {?>
							<a href="<?php echo $link; ?>" class="<?php if($gallery->page == ($i - 1)) { echo 'selected'; } ?>"><?php echo $i; ?></a>
							<?php } ?>

						</div>

						<div class="button next <?php if($nextBtnClass){ echo $nextBtnClass; } ?>">

							<a href="<?php echo $nextBtn; ?>">></a>

						</div>

				</div>


				<?php } else {

					echo "Could not find the album you where looking for...";

				} ?>

			</article>

			<aside class="col1-3">

				<h3>Extras</h3>
				<p>
					On request we can check your oil levels and screen wash.
					<br><br />
					We will always report back to you any damage that you may not know about or we feel it would make your vehicle unsafe to drive.
				</p>

				<div class="find-button">
					<a href="contact.php"><span><span>Find Us</a>
				</div>

			</aside>

		</div>
	</div>

<?php include "includes/footer.php"; ?>
