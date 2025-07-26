<?php

declare(strict_types=1);


namespace App\Pipelines\Orderables;
use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderById
{
    private array $orders = [];

    public function __construct(public readonly Request $request)
    {
        $this->orders = $request->input('orders', []);
    }

    public function handle(Builder $query, Closure $next): Builder
    {
        $order = array_filter($this->orders, fn($order) => $order['column'] === 'id');
        if (empty(reset($order)['value'])) return $next($query);

        return $next($query)->orderBy(
            reset($order)['column'],
            reset($order)['value']
        );
    }
}