<?php

ini_set('display_errors', '1');

// Sets up Gallery class (defines options)
// Adds functions for navigation of gallery
include "inc/gallery-config.php";

?>

<!DOCTYPE html>
<head>

<title>NoDb Gallery</title>

</head>
<body>

	<h1>NoDb Gallery</h1>

	<?php

	// Loop for gallery
	include "inc/gallery.php";

	?>

	<a href="<?php echo backDir(); ?>">Back</a>

	<a href="<?php echo backBtn($gallery->page); ?>"><</a>

	<?php echo pagiNum($gallery->page, $gallery->pageCount()); ?>

	<a href="<?php echo nextBtn($gallery->page, $gallery->pageCount()); ?>">></a>


</body>
