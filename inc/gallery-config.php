<?php

//========================================

// ** NodB Gallery Config **

// Most properties come predefined, but below
// are a few examples of what can be
// modified

//========================================

include "class/gallery.php"; // Gallery class

//--------------------

// * object setup *

//--------------------

$dir = 'images/folio/';

$gallery = new Gallery($dir);

$gallery->limit = 8; // (default: 8)

$gallery->showAlbums = true; // (default: true) show albums within gallery

//--------------------

// * contoller code *

//--------------------

if(isset($_GET['p'])) {

	$gallery->page = $_GET['p'];

} else {

	$gallery->page = 0;

}


if(isset($_GET['a'])) {

	// variable used throughout controller code
	$album = $_GET['a'];

	// Establishes correct directory
	$gallery->dir = $gallery->dir . '' . urldecode($album) . '/';

}

//--------------------

// * Builds array of images/dirs *

//--------------------

if($gallery->isValidDir() || !isset($album)) {

	$gallery->setAlbum();

}

//--------------------

// * Navigation links for Gallery *

//--------------------

include "class/gallery-nav.php";


?>
