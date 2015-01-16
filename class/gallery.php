<?php


//---------------------------------------


// ** NoDb Gallery ** \\


//---------------------------------------


/*
Name: NoDb Gallery
Repo: http://gitaddress---
Description: Gallery from folders on website
Version: 1.0
Author: Sam Roberton
Author URI: http://www.sjroberton.co.uk
*/


//---------------------------------------




class Gallery {




	// Directory of gallery/album
	public $dir;

	// Total count of images (includes folders)
	public $countImages = 0;

	// Count of directories within album
	public $countDirs = 0;

	// Limit of items shown per page
	public $limit = 8;

	// Array combining images/folders
	public $album = array();

	// Name of current album
	public $ablumName;

	// Used to get album name
	public $albumUrl;

	// Holds valid directories
	public $directory = array();

	// Total number of pages in album
	public $pages;

	// Current page
	public $page;

	// Starting item of album
	public $startImage;

	// Last item of album
	public $endImage;

	// Sorted and counted array of images/folders
	public $selectedImages = array();

	// Directory of thumbnail folder
	public $thumbDir;

	// Thumbnail prefix
	public $thumbPfx;




	function __construct($dir) {

		$this->dir = $dir;

		if(isset($_GET['p'])) { // PAGE HANDLER FALLBACK

			$this->page = $_GET['p'];

		} else {

			$this->page = 0;
		}

		if(isset($_GET['a'])) {

			$this->albumUrl = $_GET['a'];

		}

		$this->thumbDir = $this->dir; // . 'thumbs';

		$this->thumbPfx = 's-';

		$this->validDirs();

	}




	//--------------------

	// ** validDirs() **

	// Builds array of folder names for input validation whilst using GET.

	//--------------------


	private function validDirs() {

		$directories = new RecursiveIteratorIterator(new ParentIterator
					   (new RecursiveDirectoryIterator($this->dir)),
					   RecursiveIteratorIterator::SELF_FIRST);

		foreach ($directories as $directory) {

			$dir = explode('/', $directory);

			$dirName = count($dir) - 1;

			array_push($this->directory, $dir[$dirName]);

		}

	}




	//--------------------

	// ** getAlbumName() **

	// Gets album name from the address.

	//--------------------

	public function getAlbumName() {

		$name = explode('/', $this->albumUrl);

		$c = count($name) - 1;

		$this->ablumName = $name[$c];

		return $this->ablumName;

	}




	//--------------------

	// ** setAlbum() **

	// This method takes each file/folder from the specified directory
	// and re-indexes them into the array that will be served.

	// The folders are shifted to begining of the array for easier navigation.

	//--------------------

	public function setAlbum() {

		$images = scandir($this->dir);

		$disallowed = array(".","..","/","_notes", ".DS_Store", "thumbs");

		foreach ($images as $image) {

			if (!in_array($image, $disallowed)) {

				if(is_dir($this->dir . $image)) {

					array_unshift($this->album, $image);

					$this->countDirs++;

					$this->countImages++;

				} else {

					array_push($this->album, $image);

					$this->countImages++;

				}

			}

		}

	}




	//--------------------

	// ** pageCount() **

	// Method to return number of pages needed for album.

	//--------------------

	public function pageCount() {

		$this->pages = ceil($this->countImages / $this->limit) - 1;

		return $this->pages;

	}




	//--------------------

	// ** getPage() **

	// Fallback method to resolve page to index of album if too far above
	// or below.

	//--------------------

	private function getPage() {

		$this->pageCount();

		if($this->page > $this->pages || $this->page <= 0) {

			$this->page = 0;

		} else {

			$this->page = $this->page;

		}

	}




	//--------------------

	// ** setLimit() **

	// Method to define image/folder starting and finishing numbers.
	// Used to refernce indexed array and serve correct image/folders.

	//--------------------

	private function setLimit() {

		$this->startImage = $this->limit * $this->page;

		$this->endImage = $this->startImage + $this->limit;

	}




	//--------------------

	// ** getAlbum() **

	// Primary method to return array with selected folders/images.
	// Used to refernce indexed array and serve correct image/folders.

	//--------------------

	public function getAlbum() {

		$this->getPage();

		$this->setLimit();

		for($i = $this->startImage; $i < $this->endImage; $i++) {

			$image = $this->album[$i];

			if($image) {

				array_push($this->selectedImages, $image);

			}

		}

		return $this->selectedImages;

	}




}
