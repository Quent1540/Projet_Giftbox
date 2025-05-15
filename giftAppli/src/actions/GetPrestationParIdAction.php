<?php
declare(strict_types=1);

namespace gift\appli\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\models\Prestation;
use Slim\Views\Twig;

class GetPrestationParIdAction {
    public function __invoke(Request $request, Response $response, array $args): Response {
        $queryParams = $request->getQueryParams();
        $id = $queryParams['id'] ?? null;
        $view = Twig::fromRequest($request);
        if (!$id) {
            $response->getBody()->write("<p>Erreur : aucun identifiant de prestation fourni dans l'URL.</p>");
            return $response->withStatus(400);
        }
        try {
            $prestation = Prestation::findOrFail($id);
            return $view->render($response, 'prestationParId.twig', [
                'prestation' => $prestation
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $response->getBody()->write("<p>Aucune prestation trouvée avec l'ID : $id</p>");
            return $response->withStatus(404);
        }
    }
}