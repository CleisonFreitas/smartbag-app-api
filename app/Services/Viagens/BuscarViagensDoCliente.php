<?php

namespace App\Services\Viagens;

use App\Enum\LimitPaginateEnum;
use App\Facades\PipeSearchFacade;
use App\Helper\Helper;
use App\Http\Resources\Viagem\ViagemResource;
use App\Models\Clientes\Cliente;
use App\Models\Viagens\Viagem;
use Illuminate\Pagination\LengthAwarePaginator;

class BuscarViagensDoCliente
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
        $result = PipeSearchFacade::search(
            query: Viagem::query(),
            searchables: $filters,
            orderables: $orderable
        )->where('cliente_id', $cliente->id)
        ->paginate(
            perPage: $paginated ? $limit : LimitPaginateEnum::LimitMax,
            page: $page
        );

        return Helper::returnPaginated(
            paginated: $result,
            items: ViagemResource::collection($result->items())
        );
    }
}
