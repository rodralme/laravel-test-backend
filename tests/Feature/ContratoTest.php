<?php

namespace Tests\Feature;

use App\Models\Contrato;
use Tests\TestCase;

class ContratoTest extends TestCase
{
    const URI = '/api/contratos';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_contrato_pode_ser_cadastrado()
    {
        $contrato = Contrato::factory()->make();

        $response = $this->postJson(self::URI, $contrato->toArray());

        $response->assertCreated()
            ->assertJson(['success' => true])
            ->assertJsonFragment(['email_contratante' => $contrato->email_contratante]);
    }
}
