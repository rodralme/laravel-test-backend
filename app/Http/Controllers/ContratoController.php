<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContratoRequest;
use App\Http\Resources\ContratoResource;
use App\Jobs\NotificarProprietarioContratacao;
use App\Models\Contrato;

class ContratoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContratoRequest $request)
    {
        $contrato = Contrato::create($request->validated());

        $this->dispatch(new NotificarProprietarioContratacao($contrato->imovel));

        return response()->json([
            'success' => true,
            'data' => new ContratoResource($contrato),
        ], 201);
    }
}
