<?php

declare(strict_types=1);

namespace App\Services\Sessoes;

use App\Http\Resources\Sessoes\SessaoResource;
use App\Models\Sessoes\Sessao;
use Illuminate\Http\Resources\Json\JsonResource;

class RemoverSessoes
{
    public function remover(Sessao $sessao): JsonResource
    {
        $sessao->delete();
        return new SessaoResource($sessao);
    }
}