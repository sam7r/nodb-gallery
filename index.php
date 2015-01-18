<?php

ini_set('display_errors', '1');

// Sets up Gallery class
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

	<a href="<?php echo $backDir; ?>">Back</a>

	<a href="<?php echo $backPage; ?>"><</a>


	<?php foreach ($albumPagi as $pagi) { echo $pagi; } ?>


	<a href="<?php echo $nexttn; ?>">></a>


</body>
