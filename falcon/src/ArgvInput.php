<?php

namespace Falcon\Framework;

use Illuminate\Validation\ValidatesWhenResolvedTrait;
use Symfony\Component\Console\Input\ArgvInput as SymfonyArgvInput;
use Illuminate\Contracts\Validation\ValidatesWhenResolved;

class ArgvInput extends SymfonyArgvInput implements ValidatesWhenResolved
{
    use ValidatesWhenResolvedTrait;
}
