<?php

namespace App\Repositories;

use App\Models\Lot;
use App\Repositories\BaseRepository;

/**
 * Class LotRepository
 * @package App\Repositories
 * @version February 25, 2023, 8:33 pm UTC
*/

class LotRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'numero'
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
        return Lot::class;
    }
}
