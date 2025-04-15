<?php

declare(strict_types=1);

namespace Bree\Cli\Commands;

use Bree\Foundation\Cli\Command;

class Hello extends Command
{
    public function __construct()
    {
        parent::__construct('hello', '[name]');
    }
}
