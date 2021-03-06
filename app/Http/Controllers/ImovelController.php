<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImovelRequest;
use App\Http\Resources\ImovelListResource;
use App\Http\Resources\ImovelResource;
use App\Models\Imovel;
use Illuminate\Http\Request;

class ImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $lista = Imovel::withCount('contrato')
            ->orderBy(
                $request->input('field', 'id'),
                $request->input('order', 'asc')
            )
            ->get();

        $data = ImovelListResource::collection($lista);

        return response()->json([
            'success' => true,
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ImovelRequest $request)
    {
        $imovel = Imovel::create($request->validated());

        return response()->json([
            'success' => true,
            'data' => new ImovelResource($imovel),
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Imovel $imovel
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Imovel $imovel)
    {
        return response()->json([
            'success' => true,
            'data' => new ImovelResource($imovel),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ImovelRequest $request
     * @param Imovel $imovel
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ImovelRequest $request, Imovel $imovel)
    {
        $imovel->update($request->validated());

        return response()->json(['success' => true]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Imovel $imovel
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        $imovel = Imovel::find($id);
        $deleted = $imovel->delete();

        return response()->json(['success' => $deleted]);
    }


    public function disponiveis()
    {
        $imoveis = Imovel::whereDoesntHave('contrato')
            ->get()
            ->map(function ($imovel) {
                return [
                    'value' => $imovel->id,
                    'label' => $imovel->descricao,
                ];
            })
            ->all();

        return response()->json([
            'success' => true,
            'data' => $imoveis,
        ]);
    }
}
