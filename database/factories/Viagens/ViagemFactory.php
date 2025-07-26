<?php

namespace Database\Factories\Viagens;

use App\Enums\ViagemStatusEnum;
use App\Models\Clientes\Cliente;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Viagens\Viagem>
 */
class ViagemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory()->lazy(),
            'destino' => $this->faker->city,
            'previsao_de_partida_destino' => Carbon::now(),
            'previsao_de_chegada_destino' => Carbon::now()->addDay(),
            'previsao_de_partida_retorno' => Carbon::now()->addDays(5),
            'previsao_de_chegada_retorno' => Carbon::now()->addDays(6),
            'status' => $this->faker->randomElement(ViagemStatusEnum::cases()),
        ];
    }
}
