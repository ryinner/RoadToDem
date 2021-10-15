<?php
require_once 'vendor/autoload.php';

$app = new \MasterOk\App();

$app->run();

$app->login->registration();