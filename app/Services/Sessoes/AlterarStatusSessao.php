<?php

declare(strict_types=1);

namespace App\Services\Sessoes;

use App\Enums\SessaoStatusEnum;
use App\Http\Resources\Sessoes\SessaoResource;
use App\Models\Sessoes\Sessao;

final class AlterarStatusSessao
{
    public function atualizar(Sessao $sessao, SessaoStatusEnum|String $status): SessaoResource
    {
        $sessao->status = $status;
        $sessao->save();
        return new SessaoResource($sessao);
    }
}
