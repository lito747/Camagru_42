<?php
session_start();
require_once 'core/route.php';
require_once 'core/Controller.php';
require_once 'core/ORM.php';
require_once 'core/View.php';
require_once 'config/setup.php';

Route::start();
?>