<?php

namespace Database\Factories\Clientes;

use App\Models\Clientes\Cliente;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Clientes\Cliente>
 */
class ClienteFactory extends Factory
{
    protected $model = Cliente::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'senha' => Hash::make($this->faker->password),
            'ativo' => $this->faker->boolean,
        ];
    }
}
