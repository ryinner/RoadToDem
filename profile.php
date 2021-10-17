<?php
session_start();

if(empty($_SESSION['login']) or $_SESSION['login']=='admin') {
    header('Location: /');
}

require_once 'vendor/autoload.php';

$app = new \MasterOk\App();

$app->run();

$app->view->init('/profile/index.php');