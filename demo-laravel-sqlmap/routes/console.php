<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('route:map {--dry-run} {--filters=}', function () {
    $dryRun = $this->option('dry-run');
    $filters = explode(',', $this->option('filters'));

    /** @var \Illuminate\Routing\RouteCollection $routeCollection */
    $routeCollection = \Illuminate\Support\Facades\Route::getRoutes();

    $routesToMap = collect($routeCollection)
        ->filter(function ($route) use ($filters) {

            return strncmp($route->getName(), $filters, strlen($filters)) !== 0;
        });

    if ($dryRun) {
        $routesToMap
            ->each(function ($route) {
                echo "{$route->methods()[0]} {$route->uri()} {$route->getName()} {$route->getActionName()}" . PHP_EOL;
            });

        return 0;
    }

    // --engine ijhttp or sqlmap ; produce request files

    return 0;
})->purpose('Display routes map')->hourly();
