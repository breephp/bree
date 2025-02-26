<?php

declare(strict_types=1);

namespace Bridget\Http\Routes;

use Bridget\Foundation\Http\Route;

class Hello extends Route
{
    public function __construct()
    {
        parent::__construct('hello', ':name?', ['GET']);
    }
}
