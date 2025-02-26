<?php

declare(strict_types=1);

namespace Bridget\Http\Routes;

use Bridget\Foundation\Cli\Command;

class Hello extends Command
{
    public function __construct()
    {
        parent::__construct('hello', '[name]');
    }
}
