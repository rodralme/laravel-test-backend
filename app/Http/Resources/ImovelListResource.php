<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImovelListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'email_proprietario' => $this->email_proprietario,
            'referencia' => $this->referencia,
            'contratado' => $this->contrato_count > 0,
        ];
    }
}
