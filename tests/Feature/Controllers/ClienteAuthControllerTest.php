<?php
namespace Tests\Feature\Controllers;

use App\Models\Clientes\Cliente;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ClienteAuthControllerTest extends TestCase
{
    #[Test]
    public function store(): void
    {
        $dados = [
            'nome' => $this->faker->name,
            'email' => $this->faker->email,
            'senha' => $this->faker->password,
        ];
        $response = $this->postJson('/api/v1/clientes/register?'.http_build_query($dados));
        $response->assertCreated();
        $this->assertTrue(
            Cliente::whereEmail(data_get($dados, 'email'))->exists()
        );
    }

    #[Test]
    public function login(): void
    {
        $dados = [
            'email' => $this->faker->email,
            'senha' => $this->faker->password,
        ];
        $cliente = Cliente::factory()->create([
            'email' => data_get($dados, 'email'),
            'senha' => Hash::make(data_get($dados, 'senha')),
        ]);
        
        $response = $this->postJson('/api/v1/clientes/login', $dados);
        $clienteDados = $response->json()['cliente'];
        $this->assertEquals($cliente->nome, data_get($clienteDados, 'nome'));
    }
}