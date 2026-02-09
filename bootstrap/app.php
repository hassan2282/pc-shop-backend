<?php

//use App\Http\Middleware\HandleAppearance;
//use App\Http\Middleware\HandleInertiaRequests;

use App\Http\Middleware\AdminMiddelware;
use Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Middleware\HandleCors;

// $app->configure('cors');
return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        api: __DIR__.'/../routes/api.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->append(HandleCors::class);
        $middleware->encryptCookies(except: ['appearance', 'sidebar_state']);
        $middleware->alias([
            'admin' => AdminMiddelware::class,
        ]);
//        $middleware->web(append: [
//            HandleAppearance::class,
//            HandleInertiaRequests::class,
//            AddLinkHeadersForPreloadedAssets::class,
//        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
