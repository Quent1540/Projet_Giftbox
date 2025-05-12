<?php
declare(strict_types=1);

namespace gift\appli\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\models\Categorie;

class GetCategoriesAction {
    public function __invoke(Request $request, Response $response, array $args): Response {
        $categories = Categorie::all();
        $html = "<!DOCTYPE html><html><head><meta charset='UTF-8'><title>Catégories</title></head><body>";
        $html .= "<h1>Catégories disponibles</h1><ul>";
        foreach ($categories as $categorie) {
            $html .= "<li><a href=\"/categorie/{$categorie->id}\">ID: {$categorie->id} - Libellé: {$categorie->libelle}</a></li>";
        }
        $html .= "</ul></body></html>";
        $response->getBody()->write($html);
        return $response;
    }
}