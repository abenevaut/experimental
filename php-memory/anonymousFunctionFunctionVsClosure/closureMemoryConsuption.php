<?php

ini_set('memory_limit', -1);

include __DIR__ . '/../heap.php';

echo heap() . PHP_EOL;

$value = 10;
$memory = memory_get_usage();

$closure = static function (int $add) use ($value) {
    $value += $add;

    echo $value;
};

$closure(10);

echo ' | ' . $value . ' | memory: ' . (memory_get_usage() - $memory) . PHP_EOL;
echo heap() . PHP_EOL;