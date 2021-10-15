<?php

namespace MasterOk;

class App
{
    public function run()
    {
        $this->registerControllers();
    }

    public function registerControllers()
    {
        $controllers = require_once 'Config/Controllers.php';
        foreach ($controllers as $key => $controller)
        {
            $this->$key = new $controller;
        }
    }
}

