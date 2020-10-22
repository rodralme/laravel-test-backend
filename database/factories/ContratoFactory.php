<?php

namespace Database\Factories;

use App\Enums\TipoPessoa;
use App\Helpers\GeradorCpfCnpj;
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

        if (TipoPessoa::FISICA === $tipoPessoa) {
            $mascara = '###.###.###-##';
            $documento = GeradorCpfCnpj::cpfRandom();
        } else {
            $mascara = '##.###.###/####-##';
            $documento = GeradorCpfCnpj::cnpjRandom();
        }

        return [
            'imovel_id' => function () {
                return Imovel::factory()->create()->id;
            },
            'tipo_pessoa' => $tipoPessoa,
            'documento' => $documento,
            'email_contratante' => $this->faker->safeEmail,
            'nome_contratante' => $this->faker->name,
        ];
    }
}
