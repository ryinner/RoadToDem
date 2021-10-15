<?php

namespace MasterOk\Controllers;

class ViewController
{
    public $dir = __DIR__.'/../views';

    /**
     * @return string
     */
    public function getDir()
    {
        return $this->dir;
    }


    public function init($content)
    {
        $dir = $this->dir;
        require_once $dir.'/layout/header.php';
        require_once $dir.$content;
        require_once $dir.'/layout/footer.php';
    }
}

