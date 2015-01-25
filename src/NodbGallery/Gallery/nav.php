<?php

//========================================

// ** NoDb Gallery link functions **

//========================================

namespace NodbGallery\Gallery;

class Nav extends Gallery
{

    //--------------------

    // * getFolders() *

    // Returns array of folders for directory navigation

    //--------------------

    public function getAlbums()
    {

        $directories = $this->scanDirs($this->root);
        $ignoredDirs = [$this->thumbDir];
        $folders = array();

        foreach ($directories as $directory) {
            foreach ($ignoredDirs as $ignore) {
                if ($ignore != $directory) {
                    $album = $this->getAlbumName($directory);
                    $albumDir = str_replace($this->root, '', $directory);
                    $folders[$album] = urlencode($albumDir);
                }
            }
        }
        return $folders;

    }

    //--------------------

    // * backDir() *

    // returns link for navigation back 1 level

    //--------------------

    public function backDir()
    {

        if ($this->albumUri) {
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

        } else {
            return '#';
        }

    }

    //--------------------

    // * backPage() *

    // Returns link to navigate back 1 page within an album

    //--------------------

    public function backPage()
    {

        if ($this->page > 0) {
            if (($this->page - 1) <= 0) {
                $backBtn = $this->location;
                if ($this->albumUri) {
                    $backBtn .= '?';
                }

            } else {
                $backBtn = $this->location . "?p=" . ($this->page - 1);
                if ($this->albumUri) {
                    $backBtn .= '&';
                }
            }

            if ($this->albumUri) {
                $backBtn .= 'a=' . $this->albumUri;
            }

        } else {
            $backBtn = '#';
        }

        return $backBtn;

    }

    //--------------------

    // * nextPage() *

    // Returns link to navigate forward 1 page within an album

    //--------------------

    public function nextPage()
    {

        if (($this->page + 1) <= $this->pages) {
            $nextBtn = $this->location . "?p=" . ($this->page + 1);
            if ($this->albumUri) {
                $nextBtn .= '&a=' . $this->albumUri;
            }

        } else {
            $nextBtn = '#';
        }

        return $nextBtn;

    }

    //--------------------

    // * Pagination *

    // Returns array of links for page selection of current album

    //--------------------

    public function pagiNum()
    {

        if ($this->pages >= 0) {
            for ($i = 0; $i <= $this->pages; $i++) {
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
}
