<?php


//--------------------

// buttons & pagination

//--------------------


function backDir($album) {

	if(isset($album)) {

		$back  = explode('/', urldecode($album));

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

		return $backLink;

	}

}




function pagiNum($page, $pageCount, $album) {

	if($pageCount >= 0) {

		for($i = 0; $i <= $pageCount; $i++) {

			$pagiLink = $_SERVER['PHP_SELF'] . '?p=' . $i;

			if(isset($album)) {

				$pagiLink .= '&a=' . $album;

			}

			$pagiNum = ($i + 1);

			$pagination[$pagiNum] = $pagiLink;
		}


		foreach($pagination as $i => $link) {

			$link = '<a href="' . $link . '"';

			if($page == ($i - 1)) {

				$link .= 'class="selected"';

			}

			$link .= '>' . $i . '</a>';

			$pagi[] = $link;

		}

		return $pagi;

	}

}




function backBtn($page, $album) {

	if(isset($page) && $page >= 0){

		if(($page - 1) >= 0) {

			if(($page - 1) == 0 && !isset($album)) {

				$backBtn = $_SERVER['PHP_SELF'];

			} else {

				$backBtn = $_SERVER['PHP_SELF'] . "?p=" . ($page - 1);

			}

			if(isset($album)) {

				$backBtn .= '&a=' . $album;

			}

		} else {

			$backBtn = '#';

		}

		return $backBtn;

	}

}




function nextBtn($page, $pageCount, $album) {
	//$gallery->countImages > $gallery->maxImages
	if($page <= $pageCount) {

		if(($page + 1) <= $pageCount) {

			$nextBtn = $_SERVER['PHP_SELF'] . "?p=" . ($page + 1);

			if(isset($album)) {

				$nextBtn .= '&a=' . $album;

			}

		} else {

			$nextBtn = '#';

		}

		return $nextBtn;

	}

}

?>
