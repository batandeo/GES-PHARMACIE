<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Produit
 * @package App\Models
 * @version February 25, 2023, 8:48 pm UTC
 *
 * @property string $libelle
 * @property string $code
 * @property integer $qte_minimal
 * @property integer $qte_init
 * @property integer $qte_final
 * @property number $prix_session
 * @property number $prix_public
 * @property integer $qte_sortie
 * @property string $date_peremp
 * @property integer $lot_id
 * @property integer $categorie_id
 */
class Produit extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'produits';


    protected $dates = ['deleted_at'];

    /**
     * @return BelongsTo
     * @description get the category.
     */
    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function lot()
    {
        return $this->belongsTo(Lot::class);
    }
    public $fillable = [
        'libelle',
        'code',
        'qte_minimal',
        'qte_init',
        'qte_final',
        'prix_session',
        'prix_public',
        'qte_sortie',
        'date_peremp',
        'lot_id',
        'categorie_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'libelle' => 'string',
        'code' => 'string',
        'qte_minimal' => 'integer',
        'qte_init' => 'integer',
        'qte_final' => 'integer',
        'prix_session' => 'float',
        'prix_public' => 'float',
        'date_peremp' => 'date',
        'qte_sortie' => 'integer',
        'lot_id' => 'integer',
        'categorie_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'libelle' => 'required',
        'code' => 'required',
        'qte_minimal' => 'numeric',
        'qte_init' => 'numeric',
        'qte_final' => 'numeric',
        'prix_session' => 'numeric',
        'prix_public' => 'numeric',
        'qte_sortie' => 'numeric',
        'date_peremp' => 'date',
        'lot_id' => 'required',
        'categorie_id' => 'required'
    ];


    /*public function users()
    {
        return $this->belongsToMany(User::class, 'acheter');
    }*/

    public function acheters()
    {
        return $this->hasMany(Acheter::class);
    }
}
