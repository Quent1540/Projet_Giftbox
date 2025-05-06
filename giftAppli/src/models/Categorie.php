<?php
namespace giftAppli\src\models;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['id', 'libelle', 'description'];
}