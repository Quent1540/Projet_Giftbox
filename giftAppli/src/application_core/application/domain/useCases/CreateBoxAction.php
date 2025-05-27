<?php
namespace gift\appli\application_core\application\domain\useCases;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class CreateBoxAction {
    public function __invoke(Request $request, Response $response, $args)
    {
        $method = $request->getMethod();
        $view = Twig::fromRequest($request);

        if ($method === 'GET') {
            return $view->render($response, 'createBox.twig');
        }

        $data = $request->getParsedBody();
        $libelle = $data['libelle'] ?? '';
        $description = $data['description'] ?? '';
        $kdo = isset($data['kdo']) ? 1 : 0;
        $message_kdo = $data['message_kdo'] ?? '';
        $montant = $data['montant'] ?? 0;
        $statut = $data['statut'] ?? 0;

        $pdo = new \PDO('mysql:host=sql;dbname=gift', 'root', 'root');
        $id = bin2hex(random_bytes(16));
        $token = bin2hex(random_bytes(8));

        $stmt = $pdo->prepare(
            "INSERT INTO box (id, token, libelle, description, montant, kdo, message_kdo, statut)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?)"
        );
        $stmt->execute([
            $id, $token, $libelle, $description, $montant, $kdo, $message_kdo, $statut
        ]);

        return $view->render($response, 'createBox.twig', [
            'success' => true,
            'libelle' => $libelle
        ]);
    }
}