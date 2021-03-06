<?php

namespace Tests\Feature;

use App\Models\Contrato;
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
        $lista = Imovel::factory(15)->create();

        $response = $this->get(self::URI);

        $response->assertJsonCount(15, 'data')
            ->assertJsonFragment(['id' => $lista->first()->id]);
    }

    public function test_imoveis_listados_exibem_status_corretamente()
    {
        $imovel1 = Imovel::factory()->create();
        $imovel2 = Imovel::factory()->create();
        Contrato::factory()->create(['imovel_id' => $imovel2->id]);

        $response = $this->get(self::URI);

        $response->assertJsonCount(2, 'data')
            ->assertJsonFragment(['id' => $imovel1->id, 'contratado' => false])
            ->assertJsonFragment(['id' => $imovel2->id, 'contratado' => true]);
    }

    public function test_imoveis_excluidos_nao_podem_ser_listados()
    {
        $lista = Imovel::factory(8)->create();
        $lista->first()->delete();

        $response = $this->get(self::URI);

        $response->assertJsonCount(7, 'data');
    }

    public function test_imovel_pode_ser_visualizado()
    {
        $imovel = Imovel::factory()->create();

        $response = $this->get(self::URI . "/{$imovel->id}");

        $response->assertStatus(200)
            ->assertJson(['success' => true]);
    }

    public function test_imovel_pode_ser_editado()
    {
        $imovel = Imovel::factory()->create();

        $novosDados = Imovel::factory()->make()->toArray();
        $response = $this->putJson(self::URI . "/{$imovel->id}", $novosDados);

        $response->assertJson(['success' => true]);
    }

    public function test_imovel_pode_ser_excluido_logicamente()
    {
        $imovel = Imovel::factory()->create();

        $response = $this->delete(self::URI . "/{$imovel->id}");

        $response->assertJson(['success' => true]);

        $imovel->refresh();
        self::assertTrue($imovel->trashed());
    }
}
