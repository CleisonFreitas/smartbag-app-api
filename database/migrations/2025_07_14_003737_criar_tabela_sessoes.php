<?php

use App\Enums\SessaoStatusEnum;
use App\Models\Clientes\Cliente;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CriarTabelaSessoes extends Migration
{
    public function up(): void
    {
        Schema::create('sessoes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Cliente::class)->constrained();
            $table->string('titulo');
            $table->text('descricao')->nullable();
            $table->dateTime('previsao')->nullable();
            $table->string('segmento');
            $table->string('status')->default(SessaoStatusEnum::PENDENTE);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessoes');
    }
};
