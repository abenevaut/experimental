<?php

declare(strict_types=1);

namespace Falcon\Framework\Contracts;

use Falcon\Framework\Application;

/**
 * @internal
 */
interface BoostrapperContract
{
    /**
     * Performs a core task that needs to be performed on
     * early stages of the framework.
     */
    public function bootstrap(Application $app): void;
}
