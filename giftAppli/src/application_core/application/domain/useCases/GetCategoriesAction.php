<?php
namespace gift\appli\application_core\application\domain\useCases;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Exception\HttpInternalServerErrorException;

class GetCategoriesAction {
    private CatalogueInterface $catalogue;

    public function __construct(CatalogueInterface $catalogue) {
        $this->catalogue = $catalogue;
    }

    public function __invoke(Request $request, Response $response, array $args): Response {
        try {
            $categories = $this->catalogue->getCategories();
            $view = Twig::fromRequest($request);
            return $view->render($response, 'categories.twig', ['categories' => $categories]);
        } catch (CatalogueException $e) {
            throw new \Slim\Exception\HttpInternalServerErrorException($request, $e->getMessage());
        }
    }
}