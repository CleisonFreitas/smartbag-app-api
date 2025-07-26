<?php

namespace App\Providers;

use App\Contracts\PipeSearchContract;
use App\Contracts\PipeSearchRepository;
use Illuminate\Support\ServiceProvider;

class RespositoryProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(PipeSearchContract::class, PipeSearchRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
