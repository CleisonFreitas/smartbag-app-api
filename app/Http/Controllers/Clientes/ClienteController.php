<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClienteRequest;
use App\Http\Resources\Clientes\ClienteResource;
use App\Models\Clientes\Cliente;
use App\Services\Clientes\AtualizarCliente;
use App\Services\Clientes\CadastrarCliente;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class ClienteController
{
    public function __construct(
        private readonly CadastrarCliente $servicoCadastrar,
        private readonly AtualizarCliente $servicoAtualizar
    ) {}

    public function index()
    {
        //
    }

    public function store(ClienteRequest $request): JsonResponse
    {
        $cliente = $this->servicoCadastrar->create(dados: $request->validated());
        return response()->json([
            new ClienteResource($cliente),
            Response::HTTP_CREATED
        ]);
    }

    public function show(Cliente $cliente)
    {
        return response()->json(new ClienteResource($cliente));
    }

    public function update(ClienteRequest $request, Cliente $cliente): JsonResponse
    {
        $cliente = $this->servicoAtualizar->update(cliente: $cliente, dados: $request->validated());
        return response()->json([
            new ClienteResource($cliente->refresh()),
        ]);
    }

    public function destroy(Cliente $cliente)
    {
        //
    }
}
