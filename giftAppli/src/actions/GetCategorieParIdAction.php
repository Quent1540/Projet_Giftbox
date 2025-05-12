<?php
declare(strict_types=1);

namespace gift\appli\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\models\Categorie;

class GetCategorieParIdAction {
    public function __invoke(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];
        try {
            $categorie = Categorie::findOrFail($id);
            $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail Catégorie</title>
</head>
<body>
    <h1>Détail de la catégorie</h1>
    <p><strong>ID :</strong> {$categorie->id}</p>
    <p><strong>Libellé :</strong> {$categorie->libelle}</p>
    <p><strong>Description :</strong> {$categorie->description}</p>
</body>
</html>
HTML;
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $html = "<p>Aucune catégorie trouvée avec l'ID : $id</p>";
        }
        $response->getBody()->write($html);
        return $response;
    }
}