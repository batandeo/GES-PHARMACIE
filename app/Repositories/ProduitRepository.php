<?php

namespace App\Repositories;

use App\Models\Produit;
use App\Repositories\BaseRepository;

/**
 * Class ProduitRepository
 * @package App\Repositories
 * @version February 25, 2023, 8:48 pm UTC
*/

class ProduitRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'libelle',
        'code',
        'qte_minimal',
        'qte_init',
        'qte_final',
        'prix_session',
        'prix_public',
        'qte_sortie',
        'date_peremp',
        'qte_sortie',
        'lot_id',
        'categorie_id'
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
        return Produit::class;
    }
}
