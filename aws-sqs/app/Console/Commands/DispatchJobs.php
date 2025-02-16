<?php

namespace App\Console\Commands;

use App\Jobs\SqsFifoJob;
use App\Jobs\SqsStandardJob;
use Illuminate\Console\Command;

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


        SqsStandardJob::dispatch()
            ->onConnection('sqs')
            ->onQueue(env('SQS_QUEUE'));


        SqsFifoJob::dispatch()
            ->onConnection('sqs-fifo')
            ->onQueue(env('SQS_QUEUE_FIFO'));


        return Command::SUCCESS;
    }
}
