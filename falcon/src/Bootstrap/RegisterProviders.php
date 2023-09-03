<?php

declare(strict_types=1);

/**
 * This file is part of Laravel Zero.
 *
 * (c) Nuno Maduro <enunomaduro@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE
 *  file that was distributed with this source code.
 */

namespace Falcon\Framework\Bootstrap;

use function collect;
use Illuminate\Foundation\Bootstrap\RegisterProviders as BaseRegisterProviders;
use Falcon\Framework\Application;
use Falcon\Framework\Contracts\BoostrapperContract;
use Falcon\Framework\Providers;
use Falcon\Framework\Providers\NullLogger\NullLoggerServiceProvider;

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
        Providers\Composer\ComposerServiceProvider::class,
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
