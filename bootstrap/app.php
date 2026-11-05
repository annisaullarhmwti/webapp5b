<?php

use App\Http\Middleware\PreventBackHistory;
use App\Http\Middleware\EnsureUserHasRole;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Tamu yang membuka halaman terlindungi dialihkan ke halaman login
        $middleware->redirectGuestsTo(fn () => route('login'));

        // Pengguna yang sudah login dialihkan ke dashboard
        $middleware->redirectUsersTo(fn () => route('dashboard'));
        $middleware->alias([
            'role' => EnsureUserHasRole::class,
            'prevent-back' => PreventBackHistory::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();