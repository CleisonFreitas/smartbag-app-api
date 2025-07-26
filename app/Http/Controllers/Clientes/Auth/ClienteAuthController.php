<?php
namespace App\Http\Controllers\Clientes\Auth;

use App\Services\Auth\Clientes\ClienteAuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final readonly class ClienteAuthController
{
    public function __construct(
        private readonly ClienteAuthService $clienteService
    ) {}

    public function register(Request $request)
    {
        $dados = $request->validate([
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:clientes,email'],
            'senha' => ['required', 'string'],
        ]);
        $retorno = $this->clienteService->register($dados);
        return response()->json($retorno, Response::HTTP_CREATED);
    }

    public function login(Request $request): JsonResponse
    {
        $dados = $request->validate([
            'email' => ['required', 'email'],
            'senha' => ['required']
        ]);

        $retorno = $this->clienteService->signIn($dados);
        return response()->json($retorno, Response::HTTP_OK);
    }
}