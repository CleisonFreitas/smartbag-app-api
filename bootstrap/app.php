<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Exception $e, Request $request) {
            $code = $e->getCode();
            // Check if the exception code is a valid HTTP status code
            if (!in_array($code, array_keys(Response::$statusTexts))) {
                $code = Response::HTTP_INTERNAL_SERVER_ERROR;
            }
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => $e->getMessage()
                ], $code);
            }
        });
    })
    ->create();
