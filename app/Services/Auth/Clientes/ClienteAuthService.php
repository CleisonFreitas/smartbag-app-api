<?php
namespace App\Services\Auth\Clientes;

use App\Http\Resources\Clientes\ClienteResource;
use App\Models\Clientes\Cliente;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class ClienteAuthService
{
    /**
     * Responsável por realizar o login do cliente.
     *
     * @param array $dados
     * @throws Exception
     * @return array{cliente: Cliente, token: string}
     */
    public function signIn(array $dados): array
    {
        $cliente = Cliente::where('email', data_get($dados, 'email'))->first();
        if (!$cliente || !Hash::check(data_get($dados, 'senha'), $cliente->senha)) {
            throw new Exception('Erro ao tentar validar o cliente', Response::HTTP_UNAUTHORIZED);
        }

        $token = $cliente->createToken(
            name: 'cliente_token',
            expiresAt: Carbon::now()->endOfCentury()
        )->plainTextToken;

        return [
            'cliente' => new ClienteResource($cliente),
            'token' => $token
        ];
    }

    /**
     * Registrar novo cliente e criar token
     * 
     * @param array $dados
     * @return array{cliente: Cliente, token: string}
     */
    public function register(array $dados): array
    {
        $senha = Hash::make(data_get($dados, 'senha'));
        data_set($dados, 'senha', $senha);

        $cliente = new Cliente;
        $cliente->fill($dados);
        $cliente->save();

        // Criando token
        $token = $cliente->createToken(
            name: 'cliente_token',
            expiresAt: Carbon::now()->endOfCentury()
        )->plainTextToken;
        return [
            'cliente' => new ClienteResource($cliente),
            'token' => $token,
        ];
    }

    public function logout()
    {
        /** @var Cliente $cliente */
        $cliente = Auth::guard('cliente')->user();
        $cliente->tokens()->delete();
        Auth::guard('cliente')->logout();
    }
}