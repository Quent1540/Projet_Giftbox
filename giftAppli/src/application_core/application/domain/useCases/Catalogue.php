<?php
namespace gift\appli\application_core\application\domain\useCases;

use gift\appli\application_core\application\domain\entities\Categorie;
use gift\appli\application_core\application\domain\entities\Prestation;
use gift\appli\application_core\application\domain\entities\Theme;
use gift\appli\application_core\application\domain\entities\CoffretType;

class Catalogue implements CatalogueInterface {
    public function getCategories(): array {
        try {
            $result = Categorie::all();
            return $result->toArray();
        } catch (\Exception $e) {
            throw new CatalogueException('Erreur lors de la récupération des catégories : ' . $e->getMessage());
        }
    }

    public function getCategorieById(int $id): array {
        try {
            return Categorie::findOrFail($id)->toArray();
        } catch (\Exception $e) {
            throw new CatalogueException('Catégorie introuvable');
        }
    }

    public function getPrestationById(string $id): array {
        try {
            return Prestation::findOrFail($id)->toArray();
        } catch (\Exception $e) {
            throw new CatalogueException('Prestation introuvable');
        }
    }

    public function getPrestationsByCategorie(int $categ_id): array {
        try {
            return Prestation::where('categorie_id', $categ_id)->get()->toArray();
        } catch (\Exception $e) {
            throw new CatalogueException('Erreur lors de la récupération des prestations');
        }
    }

    public function getThemesCoffrets(): array {
        try {
            return Theme::all()->toArray();
        } catch (\Exception $e) {
            throw new CatalogueException('Erreur lors de la récupération des thèmes');
        }
    }

    public function getCoffretById(int $id): array {
        try {
            return CoffretType::findOrFail($id)->toArray();
        } catch (\Exception $e) {
            throw new CatalogueException('Coffret introuvable');
        }
    }
}