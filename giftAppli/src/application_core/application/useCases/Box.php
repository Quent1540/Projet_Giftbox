<?php
namespace gift\appli\application_core\application\useCases;

use gift\appli\application_core\application\exceptions\BoxException;
use gift\appli\application_core\domain\entities\CoffretType;
use gift\appli\application_core\domain\entities\Prestation;
use gift\appli\application_core\domain\entities\Theme;

class Box implements BoxInterface {
    public function getThemesCoffrets(): array {
        try {
            $themes = Theme::all()->toArray();
            foreach ($themes as &$theme) {
                $theme['coffrets'] = CoffretType::where('theme_id', $theme['id'])->get()->toArray();
            }
            return $themes;
        } catch (\Exception $e) {
            throw new BoxException('Erreur lors de la récupération des thèmes et coffrets : ' . $e->getMessage());
        }
    }

    public function getCoffretById(int $id): array {
        try {
            return CoffretType::findOrFail($id)->toArray();
        } catch (\Exception $e) {
            throw new BoxException('Coffret introuvable');
        }
    }

    public function getPrestationsByCoffret(int $id): array {
        try {
            return Prestation::join('coffret2presta', 'prestation.id', '=', 'coffret2presta.presta_id')
                ->where('coffret2presta.coffret_id', $id)
                ->get(['prestation.id', 'prestation.libelle', 'prestation.tarif'])
                ->toArray();
        } catch (\Exception $e) {
            throw new BoxException('Erreur lors de la récupération des prestations : ' . $e->getMessage());
        }
    }

    public function getPrestationById(string $id): array {
        try {
            return Prestation::findOrFail($id)->toArray();
        } catch (\Exception $e) {
            throw new BoxException('Prestation introuvable');
        }
    }
}