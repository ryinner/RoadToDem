<?php
require_once 'vendor/autoload.php';

$app = new \MasterOk\App();

$app->run();
// Выбор нужного метода для CategoryController
switch ($_POST['action']) {
    case 'add':
        $app->category->add();
        break;
    case 'delete':
        $app->category->delete();
        break;
    case 'get':
        $app->category->get();
        break;
}