<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class Lot
 * @package App\Models
 * @version February 25, 2023, 8:33 pm UTC
 *
 * @property string $numero
 */
class Lot extends Model
{
    use SoftDeletes;

    use HasFactory;

    public $table = 'lots';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'numero'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'numero' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'numero' => 'required|unique:lots'
    ];


}
