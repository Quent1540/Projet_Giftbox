<?php
namespace gift\appli\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use gift\appli\models\CoffretType;

class GetCoffretDetailAction {
    public function __invoke(Request $request, Response $response, array $args): Response {
        $id = $args['id'];
        $coffret = CoffretType::with(['theme', 'prestations'])->find($id);
        if (!$coffret) {
            $response->getBody()->write('Coffret non trouvé');
            return $response->withStatus(404);
        }
        $view = Twig::fromRequest($request);
        return $view->render($response, 'coffretDetail.twig', [
            'coffret' => $coffret,
            'prestations' => $coffret->prestations
        ]);
    }
}