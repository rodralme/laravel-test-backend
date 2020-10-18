<?php

namespace Database\Factories;

use App\Enums\UF;
use App\Models\Imovel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImovelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Imovel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email_proprietario' => $this->faker->email,
            'rua' => $this->faker->address,
            'numero' => $this->faker->optional()->numberBetween(1, 5000),
            'complemento' => $this->faker->optional()->numberBetween(1, 500),
            'bairro' => $this->faker->city,
            'cidade' => $this->faker->city,
            'estado' => $this->faker->randomElement(UF::values()),
        ];
    }
}
