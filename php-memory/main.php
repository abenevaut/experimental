<?php

ini_set('memory_limit', -1);

function heap() {
    // PHP_OS_FAMILY === 'Linux'
    $status = 'grep "VMRSS:" /proc/%s/status';

    if (PHP_OS_FAMILY === 'Windows') {
        $status = 'tasklist /FI "PID eq %s"';
    }

    return shell_exec(sprintf($status, getmypid()));
}


echo heap();

/* Stress memory by allocating */
$a = range(1, 1024*1024);

echo heap();

/* Stress memory by freeing */
unset($a);

echo heap();
