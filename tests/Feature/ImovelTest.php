<?php

namespace Tests\Feature;

use App\Models\Imovel;
use Tests\TestCase;

class ImovelTest extends TestCase
{
    const URI = '/api/imoveis';

    public function test_imovel_pode_ser_cadastrado()
    {
        $imovel = Imovel::factory()->make();

        $response = $this->postJson(self::URI, $imovel->toArray());

        $response->assertCreated()
            ->assertJson(['success' => true])
            ->assertJsonFragment(['email_proprietario' => $imovel->email_proprietario]);
    }

    public function test_imovel_pode_ser_cadastrado_dados_minimos()
    {
        $imovel = Imovel::factory()->make([
            'numero' => null,
            'complemento' => null,
        ]);
        $response = $this->postJson(self::URI, $imovel->toArray());

        $response->assertCreated()
            ->assertJson(['success' => true]);
    }

    public function test_imovel_esta_sendo_validado()
    {
        $response = $this->postJson(self::URI, []);

        $response->assertStatus(422);
    }

    public function test_imoveis_podem_ser_listados()
    {
        $this->markTestIncomplete();

        Imovel::factory(25)->create();

        $response = $this->get(self::URI);

        $response->assertJsonFragment(['total' => 25]);
    }
}
