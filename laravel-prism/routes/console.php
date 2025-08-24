<?php

use Illuminate\Support\Facades\Artisan;

Artisan::command('ask', function () {

    $response = \Prism\Prism\Prism::text()
        ->using(\Prism\Prism\Enums\Provider::Ollama, 'qwen3:0.6b')
        ->withPrompt('Combien font 2+2?')
        ->withClientOptions(['timeout' => 3600])
        ->asText();

    var_dump($response->text);

})->purpose('Ask ollama agent');
