<?php
declare(strict_types=1);

namespace App\Http\Controllers\Viagens;

use App\Http\Requests\ViagemRequest;
use App\Models\Viagens\Viagem;
use App\Pipelines\Orderables\OrderById;
use App\Pipelines\Orderables\OrderByUpdateAt;
use App\Pipelines\Searchables\FilterById;
use App\Services\Viagens\AtualizarViagensDoCliente;
use App\Services\Viagens\BuscarViagensDoCliente;
use App\Services\Viagens\CadastrarViagensDoCliente;
use App\Services\Viagens\RemoverViagensDoCliente;
use App\Traits\CrudControllerTrait;
use Illuminate\Http\JsonResponse;

final class ViagensController
{
    use CrudControllerTrait {
        store as asStore;
        update as asUpdate;
    }

    protected array $pipeFilters = [
        'id' => FilterById::class,
    ];

    protected array $pipeOrders = [
        'id' => OrderById::class,
        'updated_at' => OrderByUpdateAt::class,
    ];

    protected $model = Viagem::class;

    public function __construct(
        private readonly BuscarViagensDoCliente $servicoBuscar,
        private readonly CadastrarViagensDoCliente $servicoCadastrar,
        private readonly AtualizarViagensDoCliente $servicoAtualizar,
        private readonly RemoverViagensDoCliente $servicRemover,
    ) {}

    public function store(ViagemRequest $request): JsonResponse
    {
        return $this->asStore($request);
    }

    public function update(int $id, ViagemRequest $request): JsonResponse
    {
        return $this->asUpdate($id, $request);
    }
}
