<?php
namespace gift\appli\webui\actions;

use gift\appli\webui\providers\AuthnProviderInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class RegisterAction {
    protected AuthnProviderInterface $authProvider;

    public function __construct(AuthnProviderInterface $authProvider) {
        $this->authProvider = $authProvider;
    }

    public function __invoke(Request $request, Response $response, $args) {
        $error = null;
        $data = $request->getParsedBody();
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        if ($this->authProvider->signin($email, $password)) {
            return $response
                ->withHeader('Location', '/')
                ->withStatus(302);
        }
            $error = "Identifiants invalides.";
        $user = $this->authProvider->getSignedInUser();
        $view = Twig::fromRequest($request);
        return $view->render($response, 'signin.twig', [
            'error' => $error,
            'user' => $user
        ]);
    }
}