<?php
//Action pour afficher la box courante en session
namespace gift\appli\webui\actions;

use gift\appli\webui\providers\CsrfTokenProvider;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class GetBoxCouranteAction {
    public function __invoke(Request $request, Response $response, $args)
    {
        $view = Twig::fromRequest($request);

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        //ID de la box en session
        $box_id = $_SESSION['box_id'] ?? null;

        //Erreur
        if (!$box_id) {
            $response->getBody()->write('Aucune box en courante');
            return $response->withStatus(404);
        }

        //Affichage de la box courante
        return $view->render($response, 'boxCourante.twig', [
            'box_id' => $box_id,
            'csrf_token' => CsrfTokenProvider::generate()
        ]);
    }
}