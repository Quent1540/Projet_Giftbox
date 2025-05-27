<?php
namespace gift\appli\application_core\application\domain\useCases;

use gift\appli\application_core\application\providers\CsrfTokenProvider;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class CreateBoxAction {
    public function __invoke(Request $request, Response $response, $args)
    {
        $method = $request->getMethod();
        $view = Twig::fromRequest($request);

        if ($method === 'GET') {
            //Génère le token CSRF et le passe au template
            $csrf_token = CsrfTokenProvider::generate();
            return $view->render($response, 'createBox.twig', [
                'csrf_token' => $csrf_token
            ]);
        }

        //Recup des données
        $data = $request->getParsedBody();

        //Verif du token csrf
        \gift\appli\application_core\application\providers\CsrfTokenProvider::check($data['csrf_token'] ?? null);

        //Validation + typage
        $libelle = $data['libelle'] ?? '';
        $description = $data['description'] ?? '';
        $kdo = isset($data['kdo']) ? 1 : 0;
        $message_kdo = $data['message_kdo'] ?? '';
        $montant = $data['montant'] ?? 0;
        $statut = $data['statut'] ?? 0;

        //Appel du service de création de box vide
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

        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }
        $_SESSION['box_id'] = $id;

        //Ajout de l'id la box dans la session
        return $view->render($response, 'createBox.twig', [
            'success' => true,
            'libelle' => $libelle,
            'csrf_token' => CsrfTokenProvider::generate()
        ]);
    }
}