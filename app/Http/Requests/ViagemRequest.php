<?php

namespace App\Http\Requests;

use App\Enums\ViagemStatusEnum;
use Illuminate\Validation\Rule;

class ViagemRequest extends BaseRequest
{
    public function rules(): array
    {
        /**
         * @inheritDoc
         */
        return [
            'destino' => ['required', 'string', 'max:255'],
            'previsao_de_partida_destino' => ['required', 'date'],
            'previsao_de_chegada_destino' => ['required', 'date'],
            'previsao_de_partida_retorno' => ['nullable', 'date'],
            'previsao_de_chegada_retorno' => ['nullable', 'date'],
            'status' => ['nullable', Rule::in(ViagemStatusEnum::cases())]
        ];
    }

    public function attributes(): array
    {
        return [
            'previsao_de_partida_destino' => 'previsão de partida ao destino',
            'previsao_de_chegada_destino' => 'previsão de chegada no destino',
            'previsao_de_partida_retorno' => 'previsão de retorno',
            'previsao_de_chegada_retorno' => 'previsão de chegada ao retorno'
        ];
    }
}
