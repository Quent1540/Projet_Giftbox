<?php
declare(strict_types=1);

namespace gift\appli\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\models\Prestation;

class GetPrestationParIdAction {
    public function __invoke(Request $request, Response $response, array $args): Response {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;
        if (!$id) {
            $html = "<p>Erreur : aucun identifiant de prestation fourni dans l'URL.</p>";
        } else {
            try {
                $prestation = Prestation::findOrFail($id);
                $html = <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détail Prestation</title>
</head>
<body>
    <h1>Détail de la prestation</h1>
    <p><strong>ID :</strong> {$prestation->id}</p>
    <p><strong>Libellé :</strong> {$prestation->libelle}</p>
    <p><strong>Description :</strong> {$prestation->description}</p>
    <p><strong>Tarif :</strong> {$prestation->tarif} € / {$prestation->unite}</p>
</body>
</html>
HTML;
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                $html = "<p>Aucune prestation trouvée avec l'ID : $id</p>";
            }
        }
        $response->getBody()->write($html);
        return $response;
    }
}