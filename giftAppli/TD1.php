<?php
declare(strict_types=1);
require 'src/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use gift\appli\models\Categorie;
use gift\appli\models\Prestation;

$config = parse_ini_file('src/conf/gift.db.conf.ini');
if ($config === false) {
    die('Erreur : Impossible de lire le fichier de configuration.');
}

$db = new DB();
$db->addConnection($config);
$db->setAsGlobal();
$db->bootEloquent();

//Requêtes
//Afficher la liste des catégories
echo "<h1>Liste des catégories</h1>";
$categories = Categorie::all();
foreach ($categories as $categorie) {
    echo "ID: " . $categorie->id . '<br>';
    echo "Libellé: " . $categorie->libelle . '<br>';
    echo "Description: " . $categorie->description . '<br>';
    echo "------------------------" . '<br>';
}

//Afficher la liste des prestations
echo "<h1>Liste des prestations</h1>";
$prestations = Prestation::all();
foreach ($prestations as $prestation) {
    echo "ID: " . $prestation->id . '<br>';
    echo "Libellé: " . $prestation->libelle . '<br>';
    echo "Description: " . $prestation->description . '<br>';
    echo "Tarif: " . $prestation->tarif . '<br>';
    echo "Unité: " . $prestation->unité . '<br>';
    echo "------------------------" . '<br>';
}

//Afficher une prestation par ID
echo "<h1>Afficher une prestation par ID</h1>";
$id = "4cca8b8e-0244-499b-8247-d217a4bc542d";
try {
    $prestation = Prestation::findOrFail($id);
    echo "ID: " . $prestation->id . '<br>';
    echo "Libellé: " . $prestation->libelle . '<br>';
    echo "Description: " . $prestation->description . '<br>';
    echo "Tarif: " . $prestation->tarif . '<br>';
    echo "Unité: " . $prestation->unité . '<br>';
} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    echo "Aucune prestation trouvée avec l'ID : " . $id;
}

//Affiche la catégorie 3 avec la liste des prestations associées
echo "<h1>Afficher la catégorie 3 avec la liste des prestations associées</h1>";
$id = 3;
try {
    $categorie = Categorie::with('prestations')->findOrFail($id);
    echo "ID: " . $categorie->id . '<br>';
    echo "Libellé: " . $categorie->libelle . '<br>';
    echo "Description: " . $categorie->description . '<br>';
    echo "<h2>Prestations associées :</h2>";
    foreach ($categorie->prestations as $prestation) {
        echo "Libellé: " . $prestation->libelle . '<br>';
        echo "Description: " . $prestation->description . '<br>';
        echo "Tarif: " . $prestation->tarif . '<br>';
        echo "Unité: " . $prestation->unité . '<br>';
        echo "------------------------" . '<br>';
    }
} catch (Illuminate\Database\Eloquent\ModelNotFoundException $e) {
    echo "Aucune catégorie trouvée avec l'ID : " . $id;
}