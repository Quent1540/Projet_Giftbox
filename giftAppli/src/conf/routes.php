<?php
declare(strict_types=1);

use gift\appli\webui\actions\GetCategorieParIdAction;
use gift\appli\webui\actions\GetCategoriesAction;
use gift\appli\webui\actions\GetPrestationParIdAction;
use gift\appli\webui\actions\GetPrestationsParCategorieAction;
use Slim\App;

return function(App $app): App {
    $app->get('/categories', GetCategoriesAction::class);
    $app->get('/categorie/{id}', GetCategorieParIdAction::class);
    $app->get('/prestations', \gift\appli\webui\actions\GetPrestationsAction::class);
    $app->get('/prestation/{id}', GetPrestationParIdAction::class);
    $app->get('/categories/{id}/prestations', GetPrestationsParCategorieAction::class);
    $app->get('/', function ($request, $response, $args) {
        $view = \Slim\Views\Twig::fromRequest($request);
        return $view->render($response, 'home.twig');
    });
    $app->get('/coffrets', \gift\appli\webui\actions\GetCoffretsAction::class);
    $app->get('/coffret/{id}', \gift\appli\webui\actions\GetCoffretDetailAction::class);
    $app->map(['GET', 'POST'], '/box/create', \gift\appli\webui\actions\CreateBoxAction::class);
    $app->get('/coffret/{coffret_id}/prestation/{id}', \gift\appli\webui\actions\GetPrestationCoffretAction::class);
    $app->post('/box/prestation/add', \gift\appli\webui\actions\AddPrestationBoxAction::class);
    $app->get('/box/courante', \gift\appli\webui\actions\GetBoxCouranteAction::class);
    return $app;
};