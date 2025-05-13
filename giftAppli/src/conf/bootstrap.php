<?php
declare(strict_types=1);

use Slim\Factory\AppFactory;
use gift\appli\utils\Eloquent;

//Chargement d'Eloquent ORM
require_once __DIR__ . '/../utils/Eloquent.php';
Eloquent::init(__DIR__ . '/gift.db.conf.ini');

//Création de l'application
$app = AppFactory::create();

$twig = \Slim\Views\Twig::create('path/to/template-dir',
    ['cache' => 'path/to/cache-dir',
        'auto_reload' => true]);

//$app->setBasePath('/Projet_Giftbox/giftAppli/public');
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);

//Chargement des routes
$app = (require_once __DIR__ . '/routes.php')($app);

return $app;