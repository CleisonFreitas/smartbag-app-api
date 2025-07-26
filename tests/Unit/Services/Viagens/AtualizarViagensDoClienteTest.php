<?php
namespace Tests\Unit\Services\Viagens;

use App\Models\Clientes\Cliente;
use App\Models\Viagens\Viagem;
use App\Services\Viagens\AtualizarViagensDoCliente;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AtualizarViagensDoClienteTest extends TestCase
{
    #[Test]
    public function atualizar(): void
    {
        $cliente = Cliente::factory()->create();
        Sanctum::actingAs(user: $cliente, guard: 'cliente');
        $dados = Viagem::factory()->for($cliente)->make()->toArray();
        $viagem = app(AtualizarViagensDoCliente::class)->atualizar(
            viagem: Viagem::factory()->create(), dados: $dados
        );
        $dadosDaViagem = $viagem->resource;
        $this->assertEquals(
            data_get($dados, 'destino'), $dadosDaViagem['destino']
        );
        $this->assertEquals(
            data_get($dados, 'cliente_id'), $cliente->id
        );
    }
}