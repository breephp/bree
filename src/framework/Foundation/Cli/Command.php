<?php

declare(strict_types=1);

namespace Bridget\Foundation\Cli;

use Bridget\Foundation\Action;

class Command extends Action
{
    public function __construct(string $name, protected string $signature = '', protected string $description = '')
    {
        parent::__construct($name);
    }
}
