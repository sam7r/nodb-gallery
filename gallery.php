<?php


include "includes/gallery.php"; // Gallery class




//--------------------

// object setup

//--------------------


$dir = 'images/gallery/'

$gallery = new Gallery($dir);

$gallery->limit = 12; // (optional: default is 8)

if(isset($_GET['a'])) {

	$gallery->dir = $gallery->dir . '' . urldecode($_GET['a']) . '/';

}

$gallery->setAlbum();

$page = $gallery->page;

$pageCount = $gallery->pageCount();




//--------------------

// album folders and images

//--------------------

if(!isset($_GET['a']) || in_array($gallery->getAlbumName(), $gallery->directory)) {

	if(isset($_GET['a'])) {

		$name = $gallery->getAlbumName()

	}

	foreach($gallery->getAlbum() as $image) {

		if(is_dir($gallery->dir . $image)) {

			$albumName = $image;

			$albumLink = $_SERVER['PHP_SELF'];

			if(isset($_GET['a'])) {

				$albumLink .= "?a=" . urlencode($_GET['a'] . '/' . $image);

			} else {

				$albumLink .= "?a=" . urlencode($image);

			}

		} else {

			$imageLink = $gallery->dir .''. $image;

			$imageThumb = $gallery->thumbDir .''. $gallery->thumbPfx .''. $image;

		}

	}

}


include "includes/gallery-pagination.php";
