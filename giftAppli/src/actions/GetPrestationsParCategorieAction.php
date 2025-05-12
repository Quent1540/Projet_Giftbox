<?php
declare(strict_types=1);

namespace gift\appli\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\models\Categorie;

class GetPrestationsParCategorieAction {
    public function __invoke(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];
        try {
            $categorie = Categorie::with('prestations')->findOrFail($id);
            $html = "<h1>{$categorie->libelle} — Prestations</h1><ul>";
            foreach ($categorie->prestations as $p) {
                $html .= "<li>{$p->libelle} - {$p->description} - {$p->tarif} € / {$p->unite}</li>";
            }
            $html .= "</ul>";
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $html = "<p>Aucune catégorie trouvée avec l'ID : $id</p>";
        }
        $response->getBody()->write($html);
        return $response;
    }
}