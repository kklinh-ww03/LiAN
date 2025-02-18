<?php
session_start();
require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\UserController;
use App\Router;



require __DIR__. '/src/Routes.php';
$uri = $_SERVER['REQUEST_URI']; 

$router->match($uri);
