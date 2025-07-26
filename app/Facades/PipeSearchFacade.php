<?php

declare(strict_types=1);

namespace App\Facades;

use App\Contracts\PipeSearchContract;
use Illuminate\Support\Facades\Facade;

class PipeSearchFacade extends Facade
{
    public static function getFacadeAccessor(): string
    {
        return PipeSearchContract::class;
    }
}

