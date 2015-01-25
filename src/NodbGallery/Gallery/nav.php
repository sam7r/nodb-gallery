<?php

//========================================

// ** NoDb Gallery Pagination & Button Functions **

// !!!! Make into seperate class that extends Gallery !!!!
// ---> Gallery_nav()

//========================================

//--------------------

// * Back a directory *

//--------------------

namespace NodbGallery\Gallery;



class Nav extends Gallery
{


    public $albumUri;

    public $location;


    public function __contruct() {

        $this->location = $_SERVER['PHP_SELF'];
        $this->albumUri = urlencode($this->albumUri);

    }


    public function backDir()
    {

        $back  = explode('/', $this->albumUri);
        $backCount = count($back) - 1;
        $backLink = $this->location;

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

    //--------------------

    // * Back a page in album *

    //--------------------

    function backPage()
    {

        if ($this->page >= 0) {
            if ($this->page == 0 && !isset($this->albumUri)) {
                $backBtn = $this->location;

            } else {
                $backBtn = $this->location . "?p=" . ($this->page - 1);
            }

            if ($this->albumUri) {
                $backBtn .= '&a=' . $this->album;
            }

        } else {
            $backBtn = '#';
        }

        return $backBtn;

    }

    //--------------------

    // * Next page in album *

    //--------------------

    function nextPage()
    {

        //if ($this->page <= $this->pageCount()) {
            if (($this->page + 1) != $this->pages) {
                $nextBtn = $this->location . "?p=" . ($this->page + 1);
                if ($this->albumUri) {
                    $nextBtn .= '&a=' . $this->albumUri;
                }
            } else {
                $nextBtn = '#';
            }
            return $nextBtn;
        //}

    }

    //--------------------

    // * Pagination *

    //--------------------
/*
    function pagiNum()
    {

        if ($this->pageCount() >= 0) {
            for ($i = 0; $i <= $this->pageCount(); $i++) {
                $pagiLink = $this->location . '?p=' . $i;

                if ($this->albumUri) {
                    $pagiLink .= '&a=' . $this->albumUri;
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
                echo $link;
            }
        }

    }
*/







}
