<?php
session_start();
require_once 'vendor/autoload.php';

$app = new \MasterOk\App();

$app->run();
// Выбор нужного метода для OrdersController
switch ($_POST['action']) {
    case 'add':
        $app->orders->add();
        break;
    case 'delete':
        $app->orders->delete();
        break;
    case 'get':
        $app->orders->get();
        break;
}