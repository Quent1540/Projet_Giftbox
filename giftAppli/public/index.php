<?php
declare(strict_types=1);
//Chargement de l'autoloader
require_once __DIR__. '/../src/vendor/autoload.php';

use Slim\Factory\AppFactory;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//Création de l'application
$app = AppFactory::create();
//$app->setBasePath('/Projet_Giftbox/giftAppli/public');
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);


//Déclaration des routes
$app = (require_once __DIR__ . '/../src/conf/routes.php')($app);

$app->run();