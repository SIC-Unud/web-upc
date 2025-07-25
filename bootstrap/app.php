<?php

use App\Http\Middleware\CheckRejectedParticipant;
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsUserActive;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'is-admin' => IsAdmin::class,
            'is-participant-active' => IsUserActive::class,
            'rejected-participant' => CheckRejectedParticipant::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
