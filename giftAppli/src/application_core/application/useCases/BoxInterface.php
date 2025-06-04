<?php
namespace gift\appli\application_core\application\useCases;

interface BoxInterface{
    public function getThemesCoffrets(): array;
    public function getCoffretById(int $id): array;
    public function getPrestationsByCoffret(string $coffret_id): array;
    public function getPrestationById(string $id): array;
    public function getPrestationsByBox(string $box_id): array;
}