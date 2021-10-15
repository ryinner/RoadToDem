<?php
session_start();
require_once 'vendor/autoload.php';


$app = new \MasterOk\App();

$app->run();

$app->view->init('/index/index.php');
