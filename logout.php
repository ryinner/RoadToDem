<?php
session_start();
require_once 'vendor/autoload.php';

$app = new \MasterOk\App();

$app->run();

$app->users->logout();

header('Location: /');