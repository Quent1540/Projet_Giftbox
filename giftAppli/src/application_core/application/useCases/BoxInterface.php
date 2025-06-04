<?php
namespace gift\appli\application_core\application\useCases;

interface BoxInterface{
    public function getThemesCoffrets(): array;
    public function getCoffretById(int $id): array;
    public function getPrestationsByCoffret(int $coffret_id): array;
    public function getPrestationById(string $id): array;
}