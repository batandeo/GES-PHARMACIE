<?php

namespace App\Repositories;

use App\Models\Acheter;
use App\Repositories\BaseRepository;

/**
 * Class AcheterRepository
 * @package App\Repositories
 * @version February 26, 2023, 12:33 am UTC
*/

class AcheterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'produit_id',
        'user_id',
        'quantite',
        'date_achat'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Acheter::class;
    }
}
