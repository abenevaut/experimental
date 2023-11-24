https://laravel-workflow.com/docs/introduction

composer create-project laravel/laravel laravel-workflow
composer require laravel-workflow/laravel-workflow
php artisan vendor:publish --provider="Workflow\Providers\WorkflowServiceProvider" --tag="migrations"

# conf `.env` database
-> DB_CONNECTION=local

# use database (users + jobs + cache + workflow)

# install
php artisan migrate

# run app
php artisan queue:work

php artisan workflow:start (routes/console.php)
-> execute basic workflow
    - `laravel-workflow/app/Workflows/MyWorkflow.php`
    - `laravel-workflow/app/Workflows/MyActivity.php`

