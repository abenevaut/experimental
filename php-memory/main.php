<?php

ini_set('memory_limit', -1);

include __DIR__ . '/heap.php';

echo heap();

/* Stress memory by allocating */
$a = range(1, 1024*1024);

echo heap();

/* Stress memory by freeing */
unset($a);

echo heap();
