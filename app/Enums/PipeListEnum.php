<?php
namespace App\Enums;

enum PipeListEnum: string
{
    case FILTERS = 'FILTERS';
    case ORDERS = 'ORDERS';

    public function name(): string
    {
        return match($this) {
            self::FILTERS => 'filters',
            self::ORDERS => 'orders',
            default => new \InvalidArgumentException('invalid pipe applied')
        };
    }
}