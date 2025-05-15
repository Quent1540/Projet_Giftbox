<?php
declare(strict_types=1);

namespace gift\appli\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\models\Categorie;
use Slim\Views\Twig;

class GetCategorieParIdAction {
    public function __invoke(Request $request, Response $response, array $args): Response {
        $id = (int) $args['id'];
        try {
            $categorie = Categorie::findOrFail($id);
            $view = Twig::fromRequest($request);
            return $view->render($response, 'categorieParId.twig', ['categorie' => $categorie]);
        } catch(\Illuminate\Database\QueryException $e) {
            //Erreurs liées à la base de données
            throw new \Slim\Exception\HttpInternalServerErrorException($request, "Une erreur est survenue lors de l'accès à la base de données.");
        } catch(\Exception $e) {
            //Autres exceptions
            throw new \Slim\Exception\HttpInternalServerErrorException($request, "Une erreur inattendue s'est produite.");
        }
    }
}