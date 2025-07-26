<?php

use App\Enums\ViagemStatusEnum;
use App\Models\Clientes\Cliente;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaViagens extends Migration
{
    public function up(): void
    {
        Schema::create('viagens', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cliente::class)->constrained();
            $table->string('destino');
            $table->dateTime('previsao_de_partida_destino');
            $table->dateTime('previsao_de_chegada_destino');
            $table->dateTime('previsao_de_partida_retorno');
            $table->dateTime('previsao_de_chegada_retorno');
            $table->string('status')->default(ViagemStatusEnum::PENDENTE);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('viagens');
    }
};
