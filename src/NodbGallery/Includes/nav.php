<?php

//========================================

// ** Gallery Navigation buttons **

//========================================

//--------------------

// * getFolders() *

// Returns a list of all folders in gallery for navigation

//--------------------

if ($nav->getAlbums()) {
?>
	<div class="gallery-menu">
		<ul>
			<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Gallery</a></li>
			<?php foreach ($nav->getAlbums() as $name => $dir) {
?>
				<li>
					<a href="<?php echo $_SERVER['PHP_SELF'] . "?a=" . $dir; ?>">
					<?php echo $name; ?>
					</a>
				</li>
			<?php
} ?>
		</ul>
	</div>

<?php
}

//--------------------

// * Back Directory *

// Moves back one directory

//--------------------

?>

<div class="btn-nav">

	<a href="<?php echo $nav->backPage(); ?>" <?php if ($gallery->page == 0) {
?> class="disabled" <?php
} ?>><</a>

</div>

<?php
//--------------------

// * Next Page *

// Moves to next page in album

//--------------------
?>

<div class="btn-nav">

	<a href="<?php echo $nav->nextPage(); ?>"
	<?php if ($gallery->page == $gallery->pages) {
    ?> class="disabled"
	<?php
} ?>>> </a>

</div>

<?php

//--------------------

// * Back Page *

// Moves back a page in the album

//--------------------

?>

<div class="btn-nav back">

	<a href="<?php echo $nav->backDir(); ?>" <?php if ($gallery->isRoot()) {
    ?> class="disabled" <?php
} ?>>Back</a>

</div>
