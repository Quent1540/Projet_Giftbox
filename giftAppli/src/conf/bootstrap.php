<?php
declare(strict_types=1);

use Slim\Factory\AppFactory;
use gift\appli\utils\Eloquent;

//Chargement d'Eloquent ORM
require_once __DIR__ . '/../utils/Eloquent.php';
Eloquent::init(__DIR__ . '/gift.db.conf.ini');

//Création de l'application
$app = AppFactory::create();


//Twig
$twig = \Slim\Views\Twig::create(__DIR__ . '/../views', [
    'cache' => false, //__DIR__ . '/../views/cache',
    'auto_reload' => true
]);
$app->add(\Slim\Views\TwigMiddleware::create($app, $twig)) ;
//$app->setBasePath('/Projet_Giftbox/giftAppli/public');
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

//Chargement des routes
$app = (require_once __DIR__ . '/routes.php')($app);

return $app;