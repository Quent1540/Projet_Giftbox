<?php
namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\application\useCases;
use gift\appli\application_core\domain\entities\User;

class AuthnService implements AuthnServiceInterface {

    public function register(string $email, string $password): bool
    {
        if (User::query()->where('user_id', $email)->exists()) {
            return false;
        }
        $user = new User();
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        return $user->save();
    }
    public function verifyCredentials(string $email, string $password): User {
        try {
            $user = User::query()->where('user_id', $email)->first();
            if ($user && password_verify($password, $user->password)) {
                return $user;
            }
            throw new \Exception("Invalid credentials");
        } catch (\Exception $e) {
            throw new \Exception("Invalid credentials");
        }
    }
}