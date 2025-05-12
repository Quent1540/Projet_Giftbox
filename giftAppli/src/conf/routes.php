<?php
declare(strict_types=1);

use Slim\App;
use gift\appli\actions\GetCategoriesAction;
use gift\appli\actions\GetPrestationsParCategorieAction;

return function(App $app): App {
    $app->get('/categories', GetCategoriesAction::class);
    $app->get('/categories/1/prestations', GetPrestationsParCategorieAction::class);
    return $app;
};