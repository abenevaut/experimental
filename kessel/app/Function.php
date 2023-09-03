<?php

namespace App;

use Falcon\Framework\ArgvInput;

function handle(ArgvInput $input)
{

    return serialize($input);

    return json_encode($input);
}
