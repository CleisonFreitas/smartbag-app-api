<?php

declare(strict_types=1);

namespace App\Contracts;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pipeline\Pipeline;

class PipeSearchRepository implements PipeSearchContract
{
    /**
     * @inheritDoc
     */
    public function search(
        Builder $query,
        array $searchables,
        array $orderables
    ): Builder
    {
        return app(Pipeline::class)
            ->send($query)
            ->through($searchables)
            ->pipe($orderables)
            ->thenReturn();
    }
}
