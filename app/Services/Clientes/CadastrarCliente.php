<?php

namespace App\Services\Clientes;

use App\Models\Clientes\Cliente;
use Illuminate\Support\Facades\Hash;

class CadastrarCliente
{
    public function create(array $dados): Cliente
    {
        $password = Hash::make(data_get($dados, 'senha'));
        data_set($dados, 'senha', $password, true);
        $cliente = Cliente::fill($dados);
        $cliente->save();
        return $cliente;
    }
}