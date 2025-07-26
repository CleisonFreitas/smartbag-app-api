<?php

use App\Http\Controllers\Clientes\Auth\ClienteAuthController;
use App\Http\Controllers\Sessoes\SessoesController;
use App\Http\Controllers\Viagens\ViagensController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function ($router) {
    $router->post('/clientes/login', [ClienteAuthController::class, 'login']);
    $router->post('/clientes/register', [ClienteAuthController::class, 'register']);

    $router->middleware('auth:sanctum')->group(function ($routerMiddleware) {
        $routerMiddleware->post('/clientes/logout', [ClienteAuthController::class, 'logout']);

        // Viagens:
        $routerMiddleware->get('/viagens', [ViagensController::class, 'index']);
        $routerMiddleware->get('/viagens/{viagem}', [ViagensController::class, 'show']);
        $routerMiddleware->post('/viagens', [ViagensController::class, 'store']);
        $routerMiddleware->put('/viagens/{viagem}', [ViagensController::class, 'update']);
        $routerMiddleware->delete('/viagens/{viagem}', [ViagensController::class, 'destroy']);

        // Sessões:
        $routerMiddleware->get('/sessoes', [SessoesController::class, 'index']);
        $routerMiddleware->post('/sessoes', [SessoesController::class, 'store']);
        $routerMiddleware->put('/sessoes/{id}', [SessoesController::class, 'update']);
        $routerMiddleware->delete('/sessoes/{id}', [SessoesController::class, 'destroy']);
        $routerMiddleware->patch('/sessoes/{id}/alterar-status', [SessoesController::class, 'alterarStatus']);
    });
});
