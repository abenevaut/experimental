<?php

function heap() {
    // PHP_OS_FAMILY === 'Linux'
    $status = 'grep "VMRSS:" /proc/%s/status';

    if (PHP_OS_FAMILY === 'Windows') {
        $status = 'tasklist /FI "PID eq %s"';
    }

    return shell_exec(sprintf($status, getmypid()));
}
