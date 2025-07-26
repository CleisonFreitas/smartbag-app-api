<?php

declare(strict_types=1);

namespace App\Services\Sessoes;

use App\Http\Resources\Sessoes\SessaoResource;
use App\Models\Clientes\Cliente;
use App\Models\Sessoes\Sessao;
use Illuminate\Http\Resources\Json\JsonResource;

class CadastrarSessoes
{
    public function cadastrar(Cliente $cliente, array $dados): JsonResource
    {
        $sessao = new Sessao;
        $sessao->fill([
            ...$dados,
            'cliente_id' => $cliente->id,
        ]);
        $sessao->save();
        $sessao->refresh();
        return new SessaoResource($sessao);
    }
}
