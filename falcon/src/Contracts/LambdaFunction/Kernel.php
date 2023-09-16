<?php

namespace Falcon\Framework\Contracts\LambdaFunction;

use Falcon\Framework\Contracts\ArgvInput;

/**
 * @todo: This file should be move to another place
 */
interface Kernel
{
    /**
     * Bootstrap the application for lambda function.
     *
     * @return void
     */
    public function bootstrap();

    /**
     * Handle an incoming lambda event.
     *
     * @param  \Falcon\Framework\Contracts\ArgvInput  $input
     * @return int
     */
    public function handle(ArgvInput $input);

    /**
     * Terminate the application.
     *
     * @param  \Falcon\Framework\Contracts\ArgvInput  $input
     * @param  int  $status
     * @return void
     */
    public function terminate(ArgvInput $input, $status);
}