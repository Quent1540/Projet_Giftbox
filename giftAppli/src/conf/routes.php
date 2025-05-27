<?php
declare(strict_types=1);

use gift\appli\application_core\application\domain\useCases\GetCategorieParIdAction;
use gift\appli\application_core\application\domain\useCases\GetCategoriesAction;
use gift\appli\application_core\application\domain\useCases\GetPrestationParIdAction;
use gift\appli\application_core\application\domain\useCases\GetPrestationsParCategorieAction;
use Slim\App;

return function(App $app): App {
    $app->get('/categories', GetCategoriesAction::class);
    $app->get('/categorie/{id}', GetCategorieParIdAction::class);
    $app->get('/prestation/{id}', GetPrestationParIdAction::class);
    $app->get('/categories/{id}/prestations', GetPrestationsParCategorieAction::class);
    $app->get('/', function ($request, $response, $args) {
        $view = \Slim\Views\Twig::fromRequest($request);
        return $view->render($response, 'home.twig');
    });
    $app->get('/coffrets', \gift\appli\application_core\application\domain\useCases\GetCoffretsAction::class);
    $app->get('/coffret/{id}', \gift\appli\application_core\application\domain\useCases\GetCoffretDetailAction::class);
    $app->map(['GET', 'POST'], '/box/nouvelle', \gift\appli\application_core\application\domain\useCases\CreateBoxAction::class);
    $app->get('/coffret/{coffret_id}/prestation/{id}', \gift\appli\application_core\application\domain\useCases\GetPrestationCoffretAction::class);
    return $app;
};