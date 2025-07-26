<?php

namespace Database\Factories\Sessoes;

use App\Enums\SegmentoEnum;
use App\Enums\SessaoStatusEnum;
use App\Models\Clientes\Cliente;
use App\Models\Sessoes\Sessao;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sessoes\Sessao>
 */
class SessaoFactory extends Factory
{
    protected $model = Sessao::class;
    public function definition(): array
    {
        return [
            'cliente_id' => Cliente::factory()->lazy(),
            'titulo' => $this->faker->words,
            'descricao' => $this->faker->sentence,
            'previsao' => $this->faker->dateTime,
            'segmento' => $this->faker->randomElement(SegmentoEnum::cases()),
            'status' => $this->faker->randomElement(SessaoStatusEnum::cases()),
        ];
    }
}
