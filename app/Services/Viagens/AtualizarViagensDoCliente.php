<?php

declare(strict_types=1);

namespace App\Services\Viagens;

use App\Http\Resources\Viagem\ViagemResource;
use App\Models\Viagens\Viagem;

class AtualizarViagensDoCliente
{
    public function atualizar(Viagem $viagem, array $dados): ViagemResource
    {
        $viagem->fill($dados);
        $viagem->save();

        return new ViagemResource($viagem);
    }
}
