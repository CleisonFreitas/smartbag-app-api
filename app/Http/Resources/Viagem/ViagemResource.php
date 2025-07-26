<?php

namespace App\Http\Resources\Viagem;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ViagemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cliente_id' => $this->cliente_id,
            'previsao_de_partida' => $this->previsao_de_partida_destino,
            'previsao_de_retorno' => $this->previsao_de_partida_retorno,
            'created_at' => $this->created_at,
            'updated_at' => $this->created_at
        ];
    }
}
