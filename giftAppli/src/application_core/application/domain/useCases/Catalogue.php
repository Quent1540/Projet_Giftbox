<?php
namespace gift\appli\application_core\application\domain\useCases;

use gift\appli\application_core\application\domain\entities\Categorie;
use gift\appli\application_core\application\domain\entities\Prestation;
use gift\appli\application_core\application\domain\entities\Theme;
use gift\appli\application_core\application\domain\entities\CoffretType;
use Illuminate\Database\QueryException;

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
            return Prestation::where('cat_id', $categ_id)->get()->toArray();
        } catch (QueryException $e) {
            throw new CatalogueException('Erreur lors de la récupération des prestations'.
                ' : ' . $e->getMessage());
        }
    }

    public function getThemesCoffrets(): array {
        try {
            $themes = Theme::all()->toArray();
            foreach ($themes as &$theme) {
                $theme['coffrets'] = CoffretType::where('theme_id', $theme['id'])->get()->toArray();
            }
            return $themes;
        } catch (\Exception $e) {
            throw new CatalogueException('Erreur lors de la récupération des thèmes et coffrets : ' . $e->getMessage());
        }
    }

    public function getCoffretById(int $id): array {
        try {
            return CoffretType::findOrFail($id)->toArray();
        } catch (\Exception $e) {
            throw new CatalogueException('Coffret introuvable');
        }
    }

    public function getPrestationsByCoffret(int $id): array {
        try {
            return Prestation::join('coffret2presta', 'prestation.id', '=', 'coffret2presta.presta_id')
                ->where('coffret2presta.coffret_id', $id)
                ->get(['prestation.id', 'prestation.libelle', 'prestation.tarif'])
                ->toArray();
        } catch (\Exception $e) {
            throw new CatalogueException('Erreur lors de la récupération des prestations : ' . $e->getMessage());
        }
    }
}