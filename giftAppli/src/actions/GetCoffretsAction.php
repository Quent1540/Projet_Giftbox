<?php
namespace gift\appli\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use gift\appli\models\CoffretType;

class GetCoffretsAction {
    public function __invoke(Request $request, Response $response, array $args): Response {
        $coffrets = CoffretType::with('theme')->get();
        $coffrets_par_theme = [];
        foreach ($coffrets as $coffret) {
            $theme = $coffret->theme ? $coffret->theme->libelle : 'Sans thème';
            $coffrets_par_theme[$theme][] = $coffret;
        }
        $view = Twig::fromRequest($request);
        return $view->render($response, 'coffrets.twig', [
            'coffrets_par_theme' => $coffrets_par_theme
        ]);
    }
}