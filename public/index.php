<?php
   
session_start();
require '../app/core/init.php';

DEBUG ? error_reporting(E_ALL) : error_reporting(0);

$app = new App;
$app->loadController();



