<?php
declare(strict_types=1);

use Slim\App;
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

return function(App $app): App {

    //Route GET /categories
    $app->get('/categories', function(Request $request, Response $response): Response {
        $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des catégories</title>
</head>
<body>
    <h1>Catégories disponibles</h1>
    <ul>
        <li>ID: 1 - Libellé: Bien-être</li>
        <li>ID: 2 - Libellé: Gastronomie</li>
        <li>ID: 3 - Libellé: Aventure</li>
    </ul>
</body>
</html>
HTML;

        $response->getBody()->write($html);
        return $response;
    });

    return $app;
};