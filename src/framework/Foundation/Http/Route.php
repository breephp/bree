<?php

declare(strict_types=1);

namespace Bridget\Foundation\Http;

use Bridget\Foundation\Action;

class Route extends Action
{
    public function __construct(string $name, protected string $path, protected array $methods = [])
    {
        parent::__construct($name);
    }
}
