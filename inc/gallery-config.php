<?php

include "class/gallery.php"; // Gallery class

//--------------------

// object setup

//--------------------


$dir = 'images/folio/';

$gallery = new Gallery($dir);

$gallery->limit = 8; // (optional: default is 8)


//--------------------

// contoller code

//--------------------


if(isset($_GET['p'])) {

	$gallery->page = $_GET['p'];

} else {

	$gallery->page = 0;
}


if(isset($_GET['a'])) {

	$album = $_GET['a'];

	$gallery->dir = $gallery->dir . '' . urldecode($album) . '/';

	$gallery->albumUrl = $album;

}


//--------------------

// complete album setup

//--------------------


$gallery->setAlbum();


//--------------------

// Navigation links for Gallery

//--------------------

include "gallery-nav.php";



?>
