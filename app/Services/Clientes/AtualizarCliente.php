<?php
namespace App\Services\Clientes;

use App\Models\Clientes\Cliente;
use Illuminate\Support\Facades\Hash;

class AtualizarCliente
{
    public function update(Cliente $cliente, array $dados)
    {
        $senha = Hash::make(data_get($dados, 'senha'));
        data_set($dados, 'senha', $senha);
        $cliente->fill($dados);
        $cliente->save();
        return $cliente;
    }
}