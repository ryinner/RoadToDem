<?php

// Возврат контроллеров для регистрации в приложении

use MasterOk\Controllers\CategoryController;
use MasterOk\Controllers\ViewController;
use MasterOk\Controllers\UsersController;

return [
    'view'     =>  ViewController::class,
    'users'    =>  UsersController::class,
    'category' =>  CategoryController::class,
];