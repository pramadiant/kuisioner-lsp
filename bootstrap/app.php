<?php

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
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
    })->create();

if (isset($_SERVER['VERCEL'])) {
    $app->useStoragePath('/tmp/storage');
    $storagePath = '/tmp/storage';
    foreach (['app', 'framework/views', 'framework/cache', 'framework/cache/data', 'framework/sessions', 'logs'] as $dir) {
        if (!is_dir("$storagePath/$dir")) {
            @mkdir("$storagePath/$dir", 0777, true);
        }
    }
}

return $app;
