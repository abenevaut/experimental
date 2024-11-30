<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

use App\Workflows\MyWorkflow;
use Workflow\WorkflowStub;

Artisan::command('workflow:start', function () {


    $workflow = WorkflowStub::make(MyWorkflow::class);
    $workflowId = $workflow->id();

    $this->info("Workflow ID: {$workflowId}");

    $workflow->start();


})->purpose('Start workflow');
