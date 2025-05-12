<?php
declare(strict_types=1);

use Slim\App;
use gift\appli\actions\GetCategoriesAction;

return function(App $app): App {
    $app->get('/categories', GetCategoriesAction::class);
    return $app;
};