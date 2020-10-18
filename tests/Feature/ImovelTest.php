<?php

namespace Tests\Feature;

use App\Models\Imovel;
use Tests\TestCase;

class ImovelTest extends TestCase
{
    const URI = '/api/imoveis';

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_imoveis_podem_ser_listados()
    {
        Imovel::factory(25)->create();

        $response = $this->get(self::URI);

        $response->assertJsonFragment(['total' => 25]);
    }
}
