<?php
declare(strict_types=1);
require 'src/vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as DB;
use giftAppli\src\models\Categorie;

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
$categories = Categorie::all();
foreach ($categories as $categorie) {
    echo "ID: " . $categorie->id . "\n";
    echo "Libellé: " . $categorie->libelle . "\n";
    echo "Description: " . $categorie->description . "\n";
    echo "------------------------\n";
}