<?php

//========================================

// ** Gallery Navigation buttons **

//========================================

//--------------------

// * getFolders() *

// Returns a list of all folders in Gallery for navigation

//--------------------

if ($gallery->getFolders()) {
?>
	<div class="gallery-menu">
		<ul>
			<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Gallery</a></li>
			<?php foreach ($gallery->getFolders() as $name => $dir) {
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

	<a href="<?php echo backBtn($gallery->page); ?>" <?php if ($gallery->page == 0) {
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

	<a href="<?php echo nextBtn($gallery->page, $gallery->pageCount()); ?>"
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

	<a href="<?php echo backDir(); ?>" <?php if ($gallery->isRoot()) {
    ?> class="disabled" <?php
} ?>>Back</a>

</div>
