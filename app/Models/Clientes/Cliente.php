<?php

namespace App\Models\Clientes;

use App\Models\Sessoes\Sessao;
use App\Models\Viagens\Viagem;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Cliente extends Authenticatable
{
    use SoftDeletes, HasFactory, HasApiTokens, Notifiable;

    protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'email',
        'senha',
        'ativo'
    ];

    protected $hidden = [
        'senha'
    ];

    protected function casts(): array
    {
        return [
            'ativo' => 'boolean'
        ];
    }

    public function viagens(): HasMany
    {
        return $this->hasMany(Viagem::class);
    }

    public function sessoes(): HasMany
    {
        return $this->hasMany(Sessao::class);
    }
}
