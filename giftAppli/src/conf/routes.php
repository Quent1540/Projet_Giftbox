<?php
declare(strict_types=1);

use Slim\App;
use gift\appli\actions\GetCategoriesAction;
use gift\appli\actions\GetPrestationsParCategorieAction;
use gift\appli\actions\GetCategorieParIdAction;
use gift\appli\actions\GetPrestationParIdAction;

return function(App $app): App {
    $app->get('/categories', GetCategoriesAction::class);
    $app->get('/categorie/{id}', GetCategorieParIdAction::class);
    $app->get('/prestation', GetPrestationParIdAction::class);
    $app->get('/categories/{id}/prestations', GetPrestationsParCategorieAction::class);
    $app->get('/', function ($request, $response, $args) {
        $view = \Slim\Views\Twig::fromRequest($request);
        return $view->render($response, 'home.twig');
    });
    return $app;
};