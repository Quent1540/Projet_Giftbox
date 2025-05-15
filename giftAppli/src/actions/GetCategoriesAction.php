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
        catch(\Exception $e){
            //gerer queryException
            //throw http internal excptionerror
            $response->getBody()->write("Erreur lors de la récupération des catégories : " . $e->getMessage());
            return $response->withStatus(500);
        }
        $response->getBody()->write($html);
        return $response;
    }
}