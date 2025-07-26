<?php

declare(strict_types=1);

namespace App\Helper;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\JsonResource;

class Helper
{
    /**
     * It should returning paginated
     * 
     * @param \Illuminate\Pagination\LengthAwarePaginator $paginated
     * @param mixed $resource
     * @return array
     */
    public static function returnPaginated(
        LengthAwarePaginator $paginated,
        array|JsonResource $items
    ): array
    {
        return [
            'current_page' => $paginated->currentPage(),
            'previos_page' => $paginated->previousPageUrl(),
            'next_page' => $paginated->nextPageUrl(),
            'last_page' => $paginated->lastPage(),
            'items' => $items,
        ];
    }
}
