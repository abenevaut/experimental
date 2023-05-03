<?php

/*
 * The terms "closure" and "anonymous function" are often used for the same thing.
 * Strictly speaking they are not the same. A closure is the combination of a function
 * and its environment. In this case the "use" keyword defines a variable in that
 * environment, which is not visible outside of it. OTOH, you could argue that the
 * first example is a closure as well, just with an empty environment.
 * see en.wikipedia.org/wiki/Closure_(computer_programming)
 *
 * https://stackoverflow.com/questions/65059432/why-memory-usage-is-bigger-for-closures#comment115021930_65059432
 */

ini_set('memory_limit', -1);

include __DIR__ . '/../heap.php';

echo heap() . PHP_EOL;

$value = 10;
$memory = memory_get_usage();

$fun = static function ($add, $value) {
    $value += $add;

    echo $value;
};

$fun(10, $value);

echo ' | ' . $value . ' | memory: ' . (memory_get_usage() - $memory) . PHP_EOL;
echo heap() . PHP_EOL;

unset($fun);

$memory = memory_get_usage();

/*
 * using default value do not influence memory usage
 */

$fun = static function ($add, $value2 = 10) {
    $value2 += $add;

    echo $value2;
};

$fun(10);

echo ' | ' . $value . ' | memory: ' . (memory_get_usage() - $memory) . PHP_EOL;
echo heap() . PHP_EOL;
