<?php
namespace App\Enums;

enum SessaoStatusEnum: string
{
    case PENDENTE = 'PENDENTE';
    case CONCLUIDO = 'CONCLUIDO';

    public function description(): string
    {
        return match($this) {
            self::PENDENTE => 'Pendente',
            self::CONCLUIDO => 'Concluído',
        };
    }
}