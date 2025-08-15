# laravel prism

- https://prismphp.com/providers/ollama.html#timeouts

```
composer require prism-php/prism
php artisan vendor:publish --tag=prism-config
```

```
PRISM_SERVER_ENABLED=true
```

```
<?php

return [
    'prism_server' => [
        // The middleware that will be applied to the Prism Server routes.
        'middleware' => [],
        'enabled' => env('PRISM_SERVER_ENABLED', false),
    ],
    'providers' => [
        'ollama' => [
            'url' => env('OLLAMA_URL', 'http://ollama:11434'),
        ],
    ],
];
```

```
<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('ask', function () {

    $prism = \Prism\Prism\Prism::text()
        ->using('ollama', 'qwen3:0.6b')
        ->withPrompt('Combien font 2+2?');

    var_dump($prism);

})->purpose('Ask ollama agent');

```


```
docker build . -f Dockerfile.dev -t laravel-prism --build-arg COMPOSER_HASH=dac665fdc30fdd8ec78b38b9800061b4150413ff2e3b6f88543c636f7cd84f6db9189d43a81e5503cda447da73c7e5b6
docker run -v ${USERPROFILE:-~}/.npmrc:/root/.npmrc -v ${USERPROFILE:-~}/.composer:/root/.composer -v .:/var/task -p 8080:8080 -p 5173:5173 laravel-prism
```
