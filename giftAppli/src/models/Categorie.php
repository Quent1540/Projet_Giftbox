<?php
namespace gift\appli\models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Categorie extends Model {
    protected $table = 'categorie';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['id', 'libelle', 'description'];

    //Une catégorie a plusieurs prestations
    public function prestations(): HasMany {
        return $this->hasMany(Prestation::class, 'cat_id');
    }
}