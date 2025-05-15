<?php
declare(strict_types=1);

namespace gift\appli\actions;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use gift\appli\models\Categorie;
use Slim\Views\Twig;

class GetCategoriesAction {
    public function __invoke(Request $request, Response $response, array $args): Response {
        try{
        $categories = Categorie::all();
        $view = Twig::fromRequest($request);
        return $view->render($response, 'categories.twig', [
            'categories' => $categories,
        ]);}
        catch(\Illuminate\Database\QueryException $e) {
            //Erreurs liées à la base de données
            throw new \Slim\Exception\HttpInternalServerErrorException($request, "Erreur lors de la récupération des catégories.");
        } catch(\Exception $e) {
            //Autres exceptions
            throw new \Slim\Exception\HttpInternalServerErrorException($request, "Une erreur inattendue s'est produite.");
        }
    }
}