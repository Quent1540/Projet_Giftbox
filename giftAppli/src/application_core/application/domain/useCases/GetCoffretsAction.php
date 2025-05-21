<?php
namespace gift\appli\application_core\application\domain\useCases;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Exception\HttpInternalServerErrorException;

class GetCoffretsAction {
    private CatalogueInterface $catalogue;

    public function __construct(CatalogueInterface $catalogue) {
        $this->catalogue = $catalogue;
    }

    public function __invoke(Request $request, Response $response, array $args): Response {
        try {
            $coffrets = $this->catalogue->getThemesCoffrets();
            $view = Twig::fromRequest($request);
            return $view->render($response, 'coffrets.twig', ['coffrets' => $coffrets]);
        } catch (CatalogueException $e) {
            throw new HttpInternalServerErrorException($request, $e->getMessage());
        }
    }
}