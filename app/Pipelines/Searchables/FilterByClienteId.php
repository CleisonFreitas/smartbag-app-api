<?php

namespace App\Pipelines\Searchables;

use Closure;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FilterByClienteId
{
    protected array $filters = [];

    public function __construct(public readonly Request $request)
    {
        $this->filters = $this->request->input('filters', []);
    }

    public function handle(Builder $query, Closure $next): Builder
    {
        $search = array_filter($this->filters, fn($filter) => $filter['column'] === 'cliente_id');
        if (empty(reset($search)['value'])) return $next($query);

        return $next($query)->when(
            !empty($search),
            fn($q) => $q->whereId(reset($search)['value'])
        );
    }
}