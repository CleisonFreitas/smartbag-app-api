<?php

declare(strict_types=1);

namespace App\Services\Viagens;

use App\Http\Resources\Viagem\ViagemResource;
use App\Models\Viagens\Viagem;

final class RemoverViagensDoCliente
{
    public function deletar(Viagem $viagem): ViagemResource
    {
        $viagem->delete();
        return new ViagemResource($viagem);
    }
}