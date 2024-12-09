https://laravel.com/docs/master/queues
https://github.com/shiftonelabs/laravel-sqs-fifo-queue

- app/Console/Commands/DispatchJobs.php

```bash
php artisan queue:work sqs --queue=sqs_queue
php artisan queue:work sqs-fifo --queue=sqs_queue_fifo
```
