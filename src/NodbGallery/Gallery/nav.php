<?php

//========================================

// ** NoDb Gallery Pagination & Button Functions **

// !!!! Make into seperate class that extends Gallery !!!!
// ---> Gallery_nav()

//========================================

//--------------------

// * Back a directory *

//--------------------

function backDir()
{

    if (isset($_GET['a'])) {
        $back  = explode('/', urldecode($_GET['a']));

        $backCount = count($back) - 1;

        $backLink = $_SERVER['PHP_SELF'];

        if ($backCount > 0) {
            for ($i = 0; $i < $backCount; $i++) {
                if ($i == ($backCount - 1)) {
                    $link = $back[$i];

                } else {
                    $link = $back[$i] .'/';

                }

            }

            $backLink = '?a=' . urlencode($link);

        }

        return $backLink;

    }

}

//--------------------

// * Pagination *

//--------------------

function pagiNum($page, $pageCount)
{

    if ($pageCount >= 0) {
        for ($i = 0; $i <= $pageCount; $i++) {
            $pagiLink = $_SERVER['PHP_SELF'] . '?p=' . $i;

            if (isset($_GET['a'])) {
                $pagiLink .= '&a=' . $_GET['a'];

            }

            $pagiNum = ($i + 1);

            $pagination[$pagiNum] = $pagiLink;
        }


        foreach ($pagination as $i => $link) {
            $link = '<a href="' . $link . '"';

            if ($page == ($i - 1)) {
                $link .= 'class="selected"';

            }

            $link .= '>' . $i . '</a>';

            //$pagi[] =
            echo $link;

            //return $pagi;

        }

    }

}

//--------------------

// * Back a page in album *

//--------------------

function backBtn($page)
{

    if (isset($page) && $page >= 0) {
        if (($page - 1) >= 0) {
            if (($page - 1) == 0 && !isset($_GET['a'])) {
                $backBtn = $_SERVER['PHP_SELF'];

            } else {
                $backBtn = $_SERVER['PHP_SELF'] . "?p=" . ($page - 1);

            }

            if (isset($_GET['a'])) {
                $backBtn .= '&a=' . $_GET['a'];

            }

        } else {
            $backBtn = '#';

        }

        return $backBtn;

    }

}

//--------------------

// * Next page in album *

//--------------------

function nextBtn($page, $pageCount)
{

    if ($page <= $pageCount) {
        if (($page + 1) <= $pageCount) {
            $nextBtn = $_SERVER['PHP_SELF'] . "?p=" . ($page + 1);

            if (isset($_GET['a'])) {
                $nextBtn .= '&a=' . $_GET['a'];

            }

        } else {
            $nextBtn = '#';

        }

        return $nextBtn;

    }

}
