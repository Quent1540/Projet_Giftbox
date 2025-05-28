<?php
namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\application\useCases;
use gift\appli\application_core\domain\entities\User;

class AuthnService implements AuthnServiceInterface {

    public function register(string $email, string $password): bool {
        if (User::query()->where('email', $email)->exists()) {
            return false;
        }
        $user = new User();
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        return $user->save();
    }

    public function verifyCredentials(string $email, string $password): bool {
        $user = User::query()->where('email', $email)->first();
        if (!$user) return false;
        return password_verify($password, $user->password);
    }
}