<?php

//========================================

// ** NodB Gallery Config **

// below are the required setting examples
// do not change the order of execution

//========================================

use NodbGallery\Gallery\Gallery;
use NodbGallery\Gallery\Nav;

$dir = 'images/folio/';

$gallery = new Gallery($dir);
$gallery->limit = 8; // (default: 8)
$gallery->showAlbums = false; // (default: true) show albums within gallery
$gallery->thumbDir = $gallery->dir . 'thumbs'; // thumbnail directory
$gallery->thumbPfx = 's-'; // thumbnail prefix

if (isset($_GET['a'])) {
    // variable used throughout controller code
    $album = $_GET['a'];
    // defines property for nav links
    $gallery->albumUri = $_GET['a'];
    // establishes correct directory
    $gallery->dir = $gallery->dir . '' . urldecode($gallery->albumUri) . '/';
}

if ($gallery->isValidDir() || !isset($album)) {
    $gallery->setAlbum();
}

$nav = new Nav($dir);
$nav->pages = $gallery->pageCount();
