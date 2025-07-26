<?php

declare(strict_types=1);

namespace App\Http\Controllers\Sessoes;

use App\Enums\SessaoStatusEnum;
use App\Http\Requests\SessaoRequest;
use App\Models\Sessoes\Sessao;
use App\Pipelines\Orderables\OrderById;
use App\Pipelines\Searchables\FilterById;
use App\Pipelines\Searchables\FilterBySegmento;
use App\Pipelines\Searchables\FilterByStatus;
use App\Services\Sessoes\AlterarStatusSessao;
use App\Services\Sessoes\AtualizarSessoes;
use App\Services\Sessoes\BuscarSessoes;
use App\Services\Sessoes\CadastrarSessoes;
use App\Services\Sessoes\RemoverSessoes;
use App\Traits\CrudControllerTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

final class SessoesController
{
    use CrudControllerTrait {
        store as asStore;
        update as asUpdate;
    }

    protected array $pipeFilters = [
        'id' => FilterById::class,
        'segmento' => FilterBySegmento::class,
        'status' => FilterByStatus::class,
    ];

    protected array $pipeOrders = [
        'id' => OrderById::class
    ];

    protected $model = Sessao::class;

    public function __construct(
        private readonly BuscarSessoes $servicoBuscar,
        private readonly CadastrarSessoes $servicoCadastrar,
        private readonly AtualizarSessoes $servicoAtualizar,
        private readonly RemoverSessoes $servicoRemover,
        private readonly AlterarStatusSessao $servicoAlterarStatus,
    ) {}

    public function store(SessaoRequest $request): JsonResponse
    {
        return $this->asStore($request);
    }

    public function update(int $id, SessaoRequest $request): JsonResponse
    {
        return $this->asUpdate($id, $request);
    }

    public function alterarStatus(int $id, Request $request): JsonResponse
    {
        $sessao = app($this->model)->findOrFail($id);
        $dados = $request->validate([
            'status' => ['required', Rule::in(SessaoStatusEnum::cases())]
        ]);
        $sessaoAtualizada = $this->servicoAlterarStatus->atualizar(
            sessao: $sessao,
            status: $dados['status']
        );
        return response()->json($sessaoAtualizada);
    }
}
