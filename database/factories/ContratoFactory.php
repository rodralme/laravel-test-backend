<?php

namespace Database\Factories;

use App\Enums\TipoPessoa;
use App\Models\Contrato;
use App\Models\Imovel;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContratoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contrato::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $tipoPessoa = $this->faker->randomElement(TipoPessoa::values());

        $mascara = TipoPessoa::FISICA === $tipoPessoa ? '###.###.###-##' : '##.###.###/####-##';

        return [
            'imovel_id' => function () {
                return Imovel::factory()->create()->id;
            },
            'tipo_pessoa' => $tipoPessoa,
            'documento' => $this->faker->numerify($mascara),
            'email_contratante' => $this->faker->safeEmail,
            'nome_contratante' => $this->faker->name,
        ];
    }
}
