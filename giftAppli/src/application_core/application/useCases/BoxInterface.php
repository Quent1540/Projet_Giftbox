<?php
namespace gift\appli\application_core\application\useCases;

interface BoxInterface{
    public function getThemesCoffrets(): array;
    public function getCoffretById(int $id): array;
    public function getPrestationsByCoffret(int $coffret_id): array;
    public function getPrestationById(string $id): array;
    public function createBox(string $createur_id, string $libelle, string $description, int $montant, int $kdo, string $message_kdo, int $statut = 1): string;
}