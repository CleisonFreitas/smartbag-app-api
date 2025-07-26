<?php
namespace App\Models\Viagens;

use App\Enums\ViagemStatusEnum;
use App\Models\Clientes\Cliente;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Viagem extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'viagens';

    protected $fillable = [
        'destino',
        'previsao_de_partida_destino',
        'previsao_de_chegada_destino',
        'previsao_de_partida_retorno',
        'previsao_de_chegada_retorno',
        'cliente_id',
        'status',
    ];

    protected $casts = [
        'cliente_id' => 'integer',
        'previsao_de_partida_destino' => 'datetime',
        'previsao_de_chegada_destino' => 'datetime',
        'previsao_de_partida_retorno' => 'datetime',
        'previsao_de_chegada_retorno' => 'datetime',
        'status' => ViagemStatusEnum::class
    ];

    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class);
    }
}