<?php
declare(strict_types=1);

namespace gift\appli\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class GetCategoriesAction
{
    public function __invoke(Request $request, Response $response, array $args): Response
    {
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
    }
}