<?php

declare(strict_types=1);

namespace App\Traits;

use App\Enums\PipeListEnum;
use App\Http\Requests\BaseRequest;
use App\Models\Clientes\Cliente;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

trait CrudControllerTrait
{
    private function getPipesList(Request $request, PipeListEnum $pipe): array
    {
        // Get the list to be checked(filters or orders)
        $pipeList = $request->input($pipe->name(), []);
        $listInformed = $pipe == PipeListEnum::FILTERS
            ? $this->pipeFilters
            : $this->pipeOrders;

        // Check if there's some filter or order that it's not permitted.
        $listDiff = array_diff(
            array_column($pipeList, 'column'),
            array_keys($listInformed)
        );
        if (!empty($listDiff)) {
            throw new Exception(
                "the {$pipe->name()}: ("
                    . implode(',', $listDiff)
                    . ") are not acceptable",
                Response::HTTP_BAD_REQUEST
            );
        }

        // Return the pipelines related to filters or orders informed.
        $pipesFiltered = array_filter($listInformed, function ($key) use ($pipeList) {
            return in_array($key, array_column($pipeList, 'column'));
        }, ARRAY_FILTER_USE_KEY);
        return array_values($pipesFiltered);
    }

    public function index(Request $request): JsonResponse
    {
        /** @var Cliente $cliente */
        $cliente = Auth::user();
        $limit = $request->input('per_page', 20);
        $page = $request->input('page', 1);
        $response = $this->servicoBuscar->buscar(
            limit: (int)$limit,
            page: (int)$page,
            cliente: $cliente,
            filters: $this->getPipesList(
                request: $request,
                pipe: PipeListEnum::FILTERS
            ),
            orderable: $this->getPipesList(
                request: $request,
                pipe: PipeListEnum::ORDERS
            ),
        );
        return response()->json($response);
    }

    public function store(BaseRequest $request): JsonResponse
    {
        /** @var Cliente $cliente */
        $cliente = Auth::user();
        $dados = $request->validated();
        $modelo = $this->servicoCadastrar->cadastrar($cliente, $dados);
        return response()->json($modelo, Response::HTTP_CREATED);
    }

    public function show(int $id): JsonResponse
    {
        /** @var Model $this->model */
        $modelo = app($this->model)->findOrFail($id);
        return response()->json($modelo);
    }

    public function update(int $id, BaseRequest $request): JsonResponse
    {
        /** @var Model $this->model */
        $modelo = app($this->model)->findOrFail($id);
        $dados = $request->validated();
        $novoModelo = $this->servicoAtualizar->atualizar($modelo, $dados);
        return response()->json($novoModelo);
    }

    public function destroy(int $id): JsonResponse
    {
        /** @var Model $this->model */
        $modelo = app($this->model)->findOrFail($id);
        $modeloRemovido = $this->servicoRemover->remover($modelo);
        return response()->json($modeloRemovido);
    }
}
