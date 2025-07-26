<?php
namespace App\Models\Sessoes;

use App\Enums\SegmentoEnum;
use App\Enums\SessaoStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sessao extends Model
{
    use HasFactory;

    protected $table = 'sessoes';

    protected $fillable = [
        'titulo',
        'descricao',
        'cliente_id',
        'segmento',
        'previsao',
        'status'
    ];

    protected $casts = [
        'cliente_id' => 'integer',
        'previsao' => 'datetime',
        'status' => SessaoStatusEnum::class,
        'segmento' => SegmentoEnum::class
    ];
}