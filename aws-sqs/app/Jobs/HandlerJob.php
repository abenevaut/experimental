<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\Job as LaravelJob;

class HandlerJob extends Job
{
    protected $data;

    /**
     * @param LaravelJob $job
     * @param array $data
     */
    public function handle(LaravelJob $job, array $data)
    {
        // This is incoming JSON payload, already decoded to an array
        var_dump($data);

        // Raw JSON payload from SQS, if necessary
        var_dump($job->getRawBody());
    }
}
