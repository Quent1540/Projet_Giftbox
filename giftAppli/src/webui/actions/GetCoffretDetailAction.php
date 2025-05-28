<?php
namespace gift\appli\webui\actions;

use gift\appli\application_core\application\exceptions\CatalogueException;
use gift\appli\application_core\application\useCases\CatalogueInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Exception\HttpNotFoundException;

class GetCoffretDetailAction {
    private CatalogueInterface $catalogue;

    public function __construct(CatalogueInterface $catalogue) {
        $this->catalogue = $catalogue;
    }

    public function __invoke(Request $request, Response $response, array $args): Response {
        try {
            $id = (int) $args['id'];
            $prestations = $this->catalogue->getPrestationsByCoffret($id);
            $view = Twig::fromRequest($request);
            return $view->render($response, 'coffretDetail.twig', [
                'prestations' => $prestations,
                'coffret_id' => $id
            ]);
        } catch (CatalogueException $e) {
            throw new HttpNotFoundException($request, $e->getMessage());
        }
    }
}