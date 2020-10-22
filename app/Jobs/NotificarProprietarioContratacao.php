<?php

namespace App\Jobs;

use App\Models\Imovel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class NotificarProprietarioContratacao implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Imovel
     */
    private $imovel;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Imovel $imovel)
    {
        $this->imovel = $imovel;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // somente exemplo de uso do job
        //
        // aqui podemos notificar o proprietário do imóvel sobre uma contratação, exemplos:
        // enviar SMS, enviar e-mail, etc
    }
}
