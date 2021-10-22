<?php
session_start();

if($_SESSION['login'] !== 'admin') {
    header('Location: /');
}

require_once 'vendor/autoload.php';

$app = new \MasterOk\App();

$app->run();

$app->view->init('/admin/index.php');