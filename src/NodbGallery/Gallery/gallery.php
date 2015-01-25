<?php

//========================================

// ** NoDb Gallery **

//========================================

// Name: NoDb Gallery
// Repo: https://github.com/sam7r/nodb-gallery
// Description: Gallery from folders on website
// Version: 1.0
// Author: Sam Roberton
// Author URI: http://www.sjroberton.co.uk

//---------------------------------------

namespace NodbGallery\Gallery;

use \RecursiveIteratorIterator;

class Gallery
{

    // Directory of gallery/album
    public $dir;

    // Unchanging root
    protected $root;

    // Total count of images & folders
    protected $count = 0;

    // Limit of items shown per page
    public $limit = 8;

    // Show albums within array
    public $showAlbums = true;

    // Array combining images/folders
    protected $album = array();

    // Holds valid directories
    protected $validDirs = array();

    // Total number of pages in album
    public $pages;

    // Current page
    public $page;

    // Starting item of album
    protected $start;

    // Last item of album
    protected $end;

    // Directory of thumbnail folder
    public $thumbDir;

    // Thumbnail prefix
    public $thumbPfx;

    // local address
    protected $location;

    // album uri
    public $albumUri;


    public function __construct($dir)
    {

        $this->dir = $dir;

        $this->root = $dir;

        $this->location = $_SERVER['PHP_SELF'];

        $this->validDirs();

        if (isset($_GET['p'])) {
            $this->page = $_GET['p'];
        }

        if (isset($_GET['a'])) {
            $this->albumUri = $_GET['a'];
        }

    }

    //--------------------

    // * isRoot() *

    // Method to determine if user is in root folder

    //--------------------

    public function isRoot()
    {

        if ($this->dir == $this->root) {
            return true;
        }

    }

    //--------------------

    // * scanDirs() *

    // Recursively scans given directory and stores into returned array

    //--------------------

    protected function scanDirs($dir)
    {

        $directories = new \RecursiveIteratorIterator(
            new \ParentIterator(
                new \RecursiveDirectoryIterator($dir)
            ),
            RecursiveIteratorIterator::SELF_FIRST
        );

        return $directories;

    }

    //--------------------

    // * validDirs() *

    // Builds array of folder names for input validation whilst using GET.

    //--------------------

    private function validDirs()
    {

        $directories = $this->scanDirs($this->root);

        foreach ($directories as $directory) {
            $directory = $directory . '/';

            array_push($this->validDirs, $directory);

        }

    }

    //--------------------

    // * isValidDir() *

    // Method to check if selected album is a valid directory

    //--------------------

    public function isValidDir()
    {

        foreach ($this->validDirs as $valid) {
            if ($this->dir == $valid) {
                return true;

            }

        }

    }

    //--------------------

    // * getAlbumName() *

    // Gets album name from the address.

    //--------------------

    public function getAlbumName($album)
    {

        $name = explode('/', $album);

        $c = count($name) - 1;

        $album = $name[$c];

        return $album;

    }

    //--------------------

    // * setAlbum() *

    // This method takes each file/folder from the specified directory
    // and re-indexes them into the array that will be served.

    // The folders are sorted and shifted to begining of the array.

    //--------------------

    public function setAlbum()
    {

        $images = scandir($this->dir);

        $ignoredFiles = array(".","..","/","_notes", ".DS_Store", "thumbs");

        $folders = array();

        foreach ($images as $image) {
            if (!in_array($image, $ignoredFiles)) {
                if (is_dir($this->dir . $image)) {
                    if ($this->showAlbums) {
                        $folders[] = $image;

                        $this->count++;

                    }

                } else {
                    array_push($this->album, $image);

                    $this->count++;

                }

            }

        }

        if ($folders) {
            arsort($folders);

            foreach ($folders as $folder) {
                array_unshift($this->album, $folder);

            }

        }

    }

    //--------------------

    // * pageCount() *

    // Method to return number of pages needed for album.

    //--------------------

    public function pageCount()
    {

        $this->pages = ceil($this->count / $this->limit) - 1;

        return $this->pages;

    }

    //--------------------

    // * getPage() *

    // Fallback method to resolve page to index of album

    //--------------------

    protected function getPage()
    {

        $this->pageCount();

        if ($this->page > $this->pages || $this->page <= 0) {
            $this->page = 0;

        } else {
            $this->page = $this->page;

        }

    }

    //--------------------

    // * setLimit() *

    // Method to define image/folder starting and finishing numbers.
    // Used to refernce indexed array and serve correct image/folders.

    //--------------------

    protected function setLimit()
    {

        $this->start = $this->limit * $this->page;

        $this->end = $this->start + $this->limit;

    }

    //--------------------

    // * getAlbum() *

    // Primary method to return array with selected folders/images.
    // Used to refernce indexed array and serve correct image/folders.

    //--------------------

    public function getAlbum()
    {

        $this->getPage();

        $this->setLimit();

        $array = array();

        for ($i = $this->start; $i < $this->end; $i++) {
            if (isset($this->album[$i])) {
                array_push($array, $this->album[$i]);

            }

        }

        return $array;

    }
}
