<?php

namespace App\Console\Commands;

use App\Jobs\HandlerJob;
use App\Jobs\SqsFifoJob;
use App\Jobs\SqsStandardJob;
use Dusterio\PlainSqs\Jobs\DispatcherJob;
use Illuminate\Console\Command;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Support\Facades\Queue;

class DispatchJobs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dispatch:jobs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dispatch experimental jobs';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {



        $object = [
            'music' => 'M.I.A. - Bad girls',
            'time' => time()
        ];

        // Pass it to dispatcher job
        $job = new DispatcherJob($object);

        // Dispatch the job as you normally would
        // By default, your data will be encapsulated in 'data' and 'job' field will be added
        app(Dispatcher::class)->dispatch($job);

        // If you wish to submit a true plain JSON, add setPlain()
        app(Dispatcher::class)->dispatch($job->setPlain());





//        Queue::connection('sqs')
//            ->pushRaw('payload1_body', env('SQS_QUEUE'));

        SqsStandardJob::dispatch()
            ->onConnection('sqs')
            ->onQueue(env('SQS_QUEUE'));

        SqsFifoJob::dispatch()
            ->onConnection('sqs-fifo')
            ->onQueue(env('SQS_QUEUE_FIFO'));


        return Command::SUCCESS;
    }
}
