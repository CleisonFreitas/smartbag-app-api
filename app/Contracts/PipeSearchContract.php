<?php
namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;

interface PipeSearchContract
{
    /**
     * It should receive the pipelines and return the query builder.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param array $searchables
     * @param array $orderables
     * @return Builder
     */
    public function search(
        Builder $query,
        array $searchables,
        array $orderables
    ): Builder;
}