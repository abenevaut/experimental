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

namespace Falcon\Framework;

use Bref\Context\Context;
use function App\handle as callFunction;
use Falcon\Framework\Contracts\LambdaFunction\Kernel as FalconKernel;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Throwable;

class Kernel implements FalconKernel
{
    /**
     * The application's bootstrap classes.
     *
     * @var string[]
     */
    protected $bootstrappers = [
        \Falcon\Framework\Bootstrap\LoadConfiguration::class,
        \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
        \Falcon\Framework\Bootstrap\RegisterFacades::class,
        \Falcon\Framework\Bootstrap\RegisterProviders::class,
        \Illuminate\Foundation\Bootstrap\BootProviders::class,
    ];

    /**
     * Kernel constructor.
     */
    public function __construct(
        \Illuminate\Contracts\Foundation\Application $app,
        \Illuminate\Contracts\Events\Dispatcher $events
    ) {
        $this->app = $app;
        $this->events = $events;
    }

    /**
     * {@inheritdoc}
     */
    public function handle($input)
    {
        try {
            $this->bootstrap();

            return callFunction($input);
        } catch (\Throwable $e) {
            $this->reportException($e);

            return fn ($event, Context $context) => json_encode(['data' => 'error', $event, $context]);
        }
    }

    /**
     * Bootstrap the application for artisan commands.
     *
     * @return void
     */
    public function bootstrap()
    {
        if (! $this->app->hasBeenBootstrapped()) {
            $this->app->bootstrapWith($this->bootstrappers());
        }

        $this->app->loadDeferredProviders();
    }

    /**
     * Terminate the application.
     *
     * @param  \Symfony\Component\Console\Input\InputInterface  $input
     * @param  int  $status
     * @return void
     */
    public function terminate($input, $status)
    {
        $this->app->terminate();
    }

    /**
     * Get the bootstrap classes for the application.
     *
     * @return array
     */
    protected function bootstrappers()
    {
        return $this->bootstrappers;
    }

    /**
     * Report the exception to the exception handler.
     *
     * @param  \Throwable  $e
     * @return void
     */
    protected function reportException(Throwable $e)
    {
        $this->app[ExceptionHandler::class]->report($e);
    }

    /**
     * Render the given exception.
     *
     * @param  \Symfony\Component\Console\Output\OutputInterface  $output
     * @param  \Throwable  $e
     * @return void
     */
    protected function renderException($output, Throwable $e)
    {
        dd('renderException');
//        $this->app[ExceptionHandler::class]->renderForConsole($output, $e);
    }
}
