
<?php if($gallery->getFolders()) : ?>

	<div class="gallery-menu">

		<ul>
				<li><a href="<?php echo $_SERVER['PHP_SELF']; ?>">Gallery</a></li>

			<?php foreach($gallery->getFolders() as $name => $dir) : ?>

				<li><a href="<?php echo $_SERVER['PHP_SELF'] . "?a=" . $dir; ?>"><?php echo $name; ?></a></li>

			<?php endforeach; ?>

		</ul>

	</div>

<?php endif; ?>


<div class="btn-nav">

	<a href="<?php echo backBtn($gallery->page); ?>" <?php if($gallery->page == 0) { ?> class="disabled" <?php } ?>><</a>

</div>

<!--<div class="pagi">

<?php echo pagiNum($gallery->page, $gallery->pageCount()); ?>

</div>-->

<div class="btn-nav">

	<a href="<?php echo nextBtn($gallery->page, $gallery->pageCount()); ?>" <?php if($gallery->page == $gallery->pages) { ?> class="disabled" <?php } ?>>></a>

</div>


<div class="btn-nav back">

	<a href="<?php echo backDir(); ?>" <?php if($gallery->isRoot()) { ?> class="disabled" <?php } ?>>Back</a>

</div>
