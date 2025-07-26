<?php

use Laravel\Sanctum\SanctumServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\RespositoryProvider::class,
    SanctumServiceProvider::class,
];
