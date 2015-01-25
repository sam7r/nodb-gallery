<?php

//========================================

// ** NodB Gallery Config **

// Most properties come predefined, but below
// are a few examples of what can be
// modified

//========================================

require '../vendor/autoload.php'; // composer autoloader
//require '../src/NodbGallery/Gallery/nav.php'; // Navigation functions

use NodbGallery\Gallery\Gallery;
use NodbGallery\Gallery\Nav;

DEFINE('GALLERY_DIR', 'images/folio/');

//--------------------

// * object setup *

//--------------------

$gallery = new Gallery(GALLERY_DIR);

$gallery->limit = 6; // (default: 8)

$gallery->showAlbums = true; // (default: true) show albums within gallery

//--------------------

// * contoller code *

//--------------------

if (isset($_GET['a'])) {
    // variable used throughout controller code
    $album = $_GET['a'];
    $gallery->albumUri = $_GET['a'];

    // Establishes correct directory
    $gallery->dir = $gallery->dir . '' . urldecode($album) . '/';

}

//--------------------

// * Builds array of images/dirs *

//--------------------

if ($gallery->isValidDir() || !isset($album)) {
    $gallery->setAlbum();

}

$nav = new Nav(GALLERY_DIR);

echo $nav->albumUri;
