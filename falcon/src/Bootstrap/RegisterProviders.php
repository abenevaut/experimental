<?php

declare(strict_types=1);

namespace Falcon\Framework\Bootstrap;

use Illuminate\Foundation\Bootstrap\RegisterProviders as BaseRegisterProviders;
use Falcon\Framework\Application;
use Falcon\Framework\Contracts\BoostrapperContract;
use Falcon\Framework\Providers;
use Falcon\Framework\Providers\NullLogger\NullLoggerServiceProvider;
use LaravelZero\Framework\Providers\Composer\ComposerServiceProvider;
use function collect;

/**
 * @internal
 */
final class RegisterProviders implements BoostrapperContract
{
    /**
     * Core providers.
     *
     * @var string[]
     */
    protected $providers = [
        NullLoggerServiceProvider::class,
        Providers\Cache\CacheServiceProvider::class,
        Providers\Filesystem\FilesystemServiceProvider::class,
        ComposerServiceProvider::class,
    ];

    /**
     * {@inheritdoc}
     */
    public function bootstrap(Application $app): void
    {
        /*
         * First, we register Laravel Foundation providers.
         */
        $app->make(BaseRegisterProviders::class)
            ->bootstrap($app);

        /*
         * Then we register Laravel Zero available providers.
         */
        collect($this->providers)
            ->each(fn ($serviceProviderClass) => $app->register($serviceProviderClass));
    }
}
