<?php

namespace Tests\Feature;

use App\Models\Contrato;
use App\Models\Imovel;
use Tests\TestCase;

class ContratoTest extends TestCase
{
    const URI = '/api/contratos';

    public function test_contrato_pode_ser_cadastrado()
    {
        $contrato = Contrato::factory()->make();

        $response = $this->postJson(self::URI, $contrato->toArray());

        $response->assertCreated()
            ->assertJson(['success' => true])
            ->assertJsonFragment(['email_contratante' => $contrato->email_contratante]);
    }

    public function test_nao_pode_contratar_imovel_ja_contratado()
    {
        // criando contrato com imóvel cadastrado
        $contrato = Contrato::factory()->create();

        // gerando dados de contrato com o imóvel já cadastrado
        $dados = Contrato::factory()->make([
            'imovel_id' => $contrato->imovel_id,
        ]);

        $response = $this->postJson(self::URI, $dados->toArray());

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['imovel_contratado']);
    }
}
