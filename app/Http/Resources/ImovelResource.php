<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ImovelResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $referencia = collect([
            $this->rua,
            $this->numero,
            $this->cidade,
            $this->estado,
        ])->filter(fn($item) => !empty($item))
            ->join(', ');

        return [
            'id' => $this->id,
            'email_proprietario' => $this->email_proprietario,
            'referencia' => $referencia,
            'status' => $this->status,
        ];
    }
}
