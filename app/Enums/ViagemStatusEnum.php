<?php
namespace App\Enums;

enum ViagemStatusEnum: string
{
    case PENDENTE = 'PENDENTE';
    case CONCLUIDA = 'CONCLUIDA';
    case CANCELADA = 'CANCELADA';

    public function descricao(): string
    {
        return match($this) {
            self::PENDENTE => 'Pendente',
            self::CONCLUIDA => 'Concluída',
            self::CANCELADA => 'Cancelada'
        };
    }
}