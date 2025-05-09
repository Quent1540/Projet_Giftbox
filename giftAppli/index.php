<?php
declare(strict_types=1);
//Chargement de l'autoloader
require 'src/vendor/autoload.php';

use Slim\Factory\AppFactory;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Création de l'application
$app = AppFactory::create();
$app->addRoutingMiddleware();

//Déclaration des routes
$app = (require_once __DIR__ . '/src/conf/routes.php')($app);

$app->run();