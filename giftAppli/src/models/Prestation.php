<?php
namespace gift\appli\models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Prestation extends Model {
    protected $table = 'prestation';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $incrementing = false;
    public $keyType = 'string';

    protected $fillable = ['id', 'libelle', 'url', 'description', 'tarif', 'unité'];

    //Une prestation appartient à une catégorie
    public function categorie(): BelongsTo {
        return $this->belongsTo(Categorie::class, 'id');
    }
}