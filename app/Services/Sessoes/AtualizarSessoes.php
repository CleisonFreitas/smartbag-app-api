<?php

declare(strict_types=1);

namespace App\Services\Sessoes;

use App\Http\Resources\Sessoes\SessaoResource;
use App\Models\Sessoes\Sessao;
use Illuminate\Http\Resources\Json\JsonResource;

class AtualizarSessoes
{
    public function atualizar(Sessao $sessao, array $dados): JsonResource
    {
        $sessao->fill($dados);
        $sessao->save();
        return new SessaoResource($sessao);
    }
}
