<?php

namespace Database\Seeders;

use App\Models\Contrato;
use App\Models\Imovel;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // cria contratos com imoveis
        Contrato::factory(10)->create();

        // cria imóveis sem contrato
        Imovel::factory(6)->create();
    }
}
