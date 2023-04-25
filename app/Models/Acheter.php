<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Acheter
 * @package App\Models
 * @version February 26, 2023, 12:33 am UTC
 *
 * @property integer $produit_id
 * @property integer $user_id
 * @property integer $quantite
 * @property string $date_achat
 */
class Acheter extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'acheters';

    //protected $primaryKey = ['user_id', 'produit_id'];

    protected $dates = ['deleted_at'];



    public $fillable = [
        'produit_id',
        'user_id',
        'quantite',
        'date_achat'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'produit_id' => 'integer',
        'user_id' => 'integer',
        'quantite' => 'integer',
        'date_achat' => 'date'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'produit_id' => 'required',
        'user_id' => 'required',
        'quantite' => 'required',
        'date_achat' => 'required'
    ];

    public function produit()
    {
        return $this->belongsTo(Produit::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

  /*  public function users()
    {
        return $this->belongsToMany(User::class, 'acheter');
    }
    public function produits()
    {
        return $this->belongsToMany(Produit::class, 'acheter');
    }*/
}
