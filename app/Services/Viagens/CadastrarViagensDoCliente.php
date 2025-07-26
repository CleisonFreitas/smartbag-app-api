<?php

declare(strict_types=1);

namespace App\Services\Viagens;

use App\Http\Resources\Viagem\ViagemResource;
use App\Models\Clientes\Cliente;
use App\Models\Viagens\Viagem;
use Illuminate\Http\Resources\Json\JsonResource;

class CadastrarViagensDoCliente
{
    /**
     * Serviço de cadastrar clientes
     *
     * @param Cliente $cliente
     * @param array $dados
     * @return ViagemResource
     */
    public function cadastrar(Cliente $cliente, array $dados): JsonResource
    {
        $viagem = new Viagem;
        $viagem->fill([...$dados, 'cliente_id' => $cliente->id]);
        $viagem->save();
        return new ViagemResource($viagem);
    }
}
