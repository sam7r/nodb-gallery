<?php

// SHOWS BACK BUTTON IF IN SUB GALLERY FOLDER

$back  = explode('/', urldecode($_GET['a']));
$backCount = count($back) - 1;
$backLink = $_SERVER['PHP_SELF'];

if($backCount > 0) {

	for($i = 0; $i < $backCount; $i++) {

		if($i == ($backCount - 1)) {

			$link .= $back[$i];

		} else {

			$link .= $back[$i] .'/';
		}
	}

	$backLink = '?a=' . urlencode($link);
}



// BACK BUTTON
if(isset($page) && $page >= 0){

	if($page <= 0) {

		$backBtnClass = 'disabled';
	}

	if(($page - 1) >= 0) {

		if(($page - 1) == 0) {

			$backBtn = $_SERVER['PHP_SELF'];

			if(isset($_GET['a'])) {

				$backBtn .= '?a=' . $_GET['a'];
			}

		} else {

			$backBtn .= $_SERVER['PHP_SELF'] . "?p=" . ($page - 1);

			if(isset($_GET['a'])) {

				$backBtn .= '&a=' . $_GET['a'];
			}
		}

	} else {

		$backBtn = '#';
	}
}


// PAGINATION NUMBERS

if($pageCount >= 0) {

	for($i = 0; $i <= $pageCount; $i++) {

		$pagiLink = $_SERVER['PHP_SELF'] . '?p=' . $i;

		if(isset($_GET['a'])) {

			$pagiLink .= '&a=' . $_GET["a"];
		}

		$pagiNum = ($i + 1);

		$pagination[$pagiNum] = $pagiLink;
	}
}


// NEXT BUTTON
if(!isset($_GET['p']) || $gallery->countImages > $gallery->maxImages && $page <= $pageCount) {

	if($page >= $pageCount){

		$nextBtnClass = 'disabled';

	}

	if(($page + 1) <= $pageCount) {

		$nextBtn = $_SERVER['PHP_SELF'] . "?p=" . ($page + 1);

		if(isset($_GET['a'])) {

			$nextBtn .= '&a=' . $_GET['a'];
		}

	} else {

		$nextBtn = '#';
	}
}


?>
