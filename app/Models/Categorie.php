<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Categorie
 * @package App\Models
 * @version February 25, 2023, 8:15 pm UTC
 *
 * @property string $libelle
 */
class Categorie extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'categories';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'libelle'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'libelle' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'libelle' => 'required|unique:categories'
    ];


}
