<?php
namespace gift\appli\application_core\application\useCases;

interface AuthnServiceInterface {
    public function register(string $email, string $password): bool;
    public function verifyCredentials(string $email, string $password): bool;
}