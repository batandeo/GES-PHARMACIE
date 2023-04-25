<?php

namespace Database\Factories;

use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProduitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Produit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'libelle' => $this->faker->word,
        'code' => $this->faker->word,
        'qte_minimal' => $this->faker->randomDigitNotNull,
        'qte_init' => $this->faker->randomDigitNotNull,
        'qte_final' => $this->faker->randomDigitNotNull,
        'prix_session' => $this->faker->randomDigitNotNull,
        'prix_public' => $this->faker->randomDigitNotNull,
        'qte_sortie' => $this->faker->randomDigitNotNull,
        'date_peremp' => $this->faker->word,
        'qte_sortie' => $this->faker->randomDigitNotNull,
        'lot_id' => $this->faker->randomDigitNotNull,
        'categorie_id' => $this->faker->randomDigitNotNull,
        'created_at' => $this->faker->date('Y-m-d H:i:s'),
        'updated_at' => $this->faker->date('Y-m-d H:i:s')
        ];
    }
}
