<?php

/*
// GALLERY SCRIPT
*/

/************

//
// NEEDS WORK TO ALLOW SORT ORDER OF FOLDERS AND IMAGES
//

************/

class Gallery {


	public $dir; // GALLERY DIRECTORY
	public $images = array(); // IMAGE ARRAY
	public $countImages = 0; // TOTAL IMAGES
	public $countDirs = 0; // DIRS COUNT
	public $maxImages = 8; // IMAGES PER PAGE
	public $album = array(); // RE-INDEX IMAGE FILES IN ARRAY
	public $ablumName; // NAME OF CURRENT ALBUM
	public $albumUrl; // URL OF CURRENT ALBUM
	public $directory = array(); // ADDS GALLERY DIRECTORIES TO ARRAY
	public $disallowed = array(); // ITEMS TO EXCLUDE
	public $pages; // COUNT OF PAGES
	public $page; // $_GET OF CURRENT PAGE
	public $startImage; // SETS WHAT IMAGE TO START WITH
	public $endImage; // SETS LAST IMAGE OF PAGE
	public $selectedImages = array();
	public $thumbDir; // DIR OF THUMBS
	public $thumbPre; // PREFIX OF THUMBS

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

		$this->thumbDir = $this->dir . 'thumbs/';
		$this->thumbPre = 'thumb-';
		$this->disallowed = array(".","..","/","_notes", ".DS_Store", "thumbs"); // ITEMS TO EXCLUDE

		$this->validDirs();

	}

	// BUILDS ARRAY OF FOLDER NAMES FOR VALIDATION
	private function validDirs() {

		$directories = new RecursiveIteratorIterator(new ParentIterator
					   (new RecursiveDirectoryIterator($this->dir)),RecursiveIteratorIterator::SELF_FIRST);

		foreach ($directories as $directory) {

			$dir = explode('/', $directory);
			$dirName = count($dir) - 1;

			array_push($this->directory, $dir[$dirName]);

		}
	}

	// RETURNS ALBUM NAME
	public function getAlbumName() {

		$name = explode('/', $this->albumUrl);
		$c = count($name) - 1;
		$this->ablumName = $name[$c];

		return $this->ablumName;

	}


	// GETS NUMBER OF IMAGES IN DIRECTORY AND INDEXES IN ARRAY
	public function setAlbum(){

		$this->images = scandir($this->dir);

		foreach ($this->images as $image) {

			if (!in_array($image, $this->disallowed)) {

				if(is_dir($this->dir . $image)) { // CHECKS TO SEE IF FILE IS DIRECTORY

					array_unshift($this->album, $image);
					$this->countDirs++;
					$this->countImages++;

				} else {

					array_push($this->album, $image); // PUSH TO NEW ARRAY FOR FRESH INDEX
					$this->countImages++;
				}
			}
		}

	}

	// COUNTS PAGES FOR PAGINATION
	public function pageCount() {

		$this->pages = ceil($this->countImages / $this->maxImages) - 1;
		return $this->pages;

	}


	// GETS PAGE NUMBER
	private function getPage() {

		$this->pageCount();

		if($this->page > $this->pages || $this->page <= 0) {

			$this->page = 0;

		} else {

			$this->page = $this->page;
		}

	}


	// START AND END IMAGE NUMBERS
	private function setLimit() {

		$this->startImage = $this->maxImages * $this->page;

		$this->endImage = $this->startImage + $this->maxImages;

	}



	public function getAlbum() {

		$this->getPage();
		$this->setLimit();

		// LOOP TO GET IMAGES
		for($i = $this->startImage; $i < $this->endImage; $i++) {
			$image = $this->album[$i];

			if($image) {

				array_push($this->selectedImages, $image);
			}
		}

		return $this->selectedImages;

	}

}

?>
