<?php

declare(strict_types=1);

namespace App\Services\Sessoes;

use App\Enum\LimitPaginateEnum;
use App\Facades\PipeSearchFacade;
use App\Helper\Helper;
use App\Http\Resources\Sessoes\SessaoResource;
use App\Models\Clientes\Cliente;
use App\Models\Sessoes\Sessao;
use App\Pipelines\Searchables\FilterByClienteId;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class BuscarSessoes
{
    public function buscar(
        Cliente $cliente,
        array $filters,
        array $orderable,
        ?int $limit = LimitPaginateEnum::LimitMin,
        ?int $page = 1,
        bool $paginated = true,
    ): LengthAwarePaginator|array
    {
        $searchable = array_merge($filters, [FilterByClienteId::class]);
        $result = PipeSearchFacade::search(
            query: Sessao::query(),
            searchables: $searchable,
            orderables: $orderable
        )->where('cliente_id', $cliente->id)
        ->paginate(
            perPage: $paginated ? $limit : LimitPaginateEnum::LimitMax,
            page: $page
        );

        return Helper::returnPaginated(
            paginated: $result,
            items: SessaoResource::collection($result->items())
        );
    }
}
