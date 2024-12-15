<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Queue Connection Name
    |--------------------------------------------------------------------------
    |
    | Laravel's queue API supports an assortment of back-ends via a single
    | API, giving you convenient access to each back-end using the same
    | syntax for every one. Here you may define a default connection.
    |
    */

    'default' => env('QUEUE_CONNECTION', 'sync'),

    /*
    |--------------------------------------------------------------------------
    | Queue Connections
    |--------------------------------------------------------------------------
    |
    | Here you may configure the connection information for each server that
    | is used by your application. A default configuration has been added
    | for each back-end shipped with Laravel. You are free to add more.
    |
    | Drivers: "sync", "database", "beanstalkd", "sqs", "redis", "null"
    |
    */

    'connections' => [

        'sync' => [
            'driver' => 'sync',
        ],

        'database' => [
            'driver' => 'database',
            'table' => 'jobs',
            'queue' => 'default',
            'retry_after' => 90,
            'after_commit' => false,
        ],

        'sqs' => [
            'driver' => 'sqs',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'prefix' => env('SQS_PREFIX', 'https://sqs.us-east-1.amazonaws.com/your-account-id'),
            'queue' => env('SQS_QUEUE', 'default'),
            'suffix' => env('SQS_SUFFIX'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'after_commit' => false,
        ],

        'sqs-fifo' => [
            'driver' => 'sqs-fifo',
            'key' => env('SQS_KEY'),
            'secret' => env('SQS_SECRET'),
            'prefix' => env('SQS_PREFIX'),
            'suffix' => env('SQS_SUFFIX'),
            'queue' => env('SQS_QUEUE_FIFO', 'default.fifo'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
            'group' => 'default',
            'deduplicator' => 'unique',
            'allow_delay' => env('SQS_ALLOW_DELAY'),
        ],

        'sqs-plain' => [
            'driver' => 'sqs-plain',
            'key'    => env('AWS_KEY', ''),
            'secret' => env('AWS_SECRET', ''),
            'prefix' => env('SQS_PREFIX'),
            'queue'  => env('SQS_QUEUE_PLAIN', 'default'),
            'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Failed Queue Jobs
    |--------------------------------------------------------------------------
    |
    | These options configure the behavior of failed queue job logging so you
    | can control which database and table are used to store the jobs that
    | have failed. You may change them to any database / table you wish.
    |
    */

    'failed' => [
        'driver' => env('QUEUE_FAILED_DRIVER', 'database-uuids'),
        'database' => env('DB_CONNECTION', 'mysql'),
        'table' => 'failed_jobs',
    ],

];
