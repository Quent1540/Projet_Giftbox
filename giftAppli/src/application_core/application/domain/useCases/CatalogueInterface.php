<?php
namespace gift\appli\application_core\application\domain\useCases;

interface CatalogueInterface {
    public function getCategories(): array;
    public function getCategorieById(int $id): array;
    public function getPrestationById(string $id): array;
    public function getPrestationsByCategorie(int $categ_id): array;
    public function getThemesCoffrets(): array;
    public function getCoffretById(int $id): array;
}