<?php
namespace Tests\Unit\Services\Viagens;

use App\Models\Clientes\Cliente;
use App\Models\Viagens\Viagem;
use App\Services\Viagens\CadastrarViagensDoCliente;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CadastrarViagensDoClienteTest extends TestCase
{
    #[Test]
    public function cadastrar(): void
    {
        $cliente = Cliente::factory()->create();
        Sanctum::actingAs(user: $cliente, guard: 'cliente');
        $dados = Viagem::factory()->for($cliente)->make()->toArray();
        $viagem = app(CadastrarViagensDoCliente::class)->cadastrar(cliente: $cliente, dados: $dados);
        $dadosDaViagem = $viagem->resource;
        $this->assertEquals(
            data_get($dados, 'destino'), $dadosDaViagem['destino']
        );
        $this->assertEquals(
            data_get($dados, 'cliente_id'), $cliente->id
        );
    }
}