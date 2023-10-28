<?php

declare(strict_types=1);

namespace Falcon\Framework\Bootstrap;

use Falcon\Framework\Application;
use Falcon\Framework\Contracts\BoostrapperContract;
use LaravelZero\Framework\Bootstrap\BaseLoadConfiguration;

/**
 * @internal
 */
final class LoadConfiguration implements BoostrapperContract
{
    /**
     * {@inheritdoc}
     */
    public function bootstrap(Application $app): void
    {
        $app->make(BaseLoadConfiguration::class)
            ->bootstrap($app);
    }
}
