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

// * Gallery setup *

//--------------------

$gallery = new Gallery(GALLERY_DIR);
$gallery->limit = 8; // (default: 8)
$gallery->showAlbums = false; // (default: true) show albums within gallery
$gallery->thumbDir = $gallery->dir . 'thumbs'; // thumbnail directory
$gallery->thumbPfx = 's-'; // thumbnail prefix

//--------------------

// * contoller code *

//--------------------

if (isset($_GET['a'])) {
    // variable used throughout controller code
    $album = $_GET['a'];

    // defines property for nav links
    $gallery->albumUri = $_GET['a'];

    // establishes correct directory
    $gallery->dir = $gallery->dir . '' . urldecode($gallery->albumUri) . '/';
}

//--------------------

// * Builds array of images/dirs *

//--------------------

if ($gallery->isValidDir() || !isset($album)) {
    $gallery->setAlbum();
}

//--------------------

// * Nav setup *

//--------------------

$nav = new Nav(GALLERY_DIR);
$nav->pages = $gallery->pageCount();
