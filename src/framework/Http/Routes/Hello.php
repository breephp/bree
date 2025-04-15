<?php

declare(strict_types=1);

namespace Bree\Http\Routes;

use Bree\Foundation\Http\Route;

class Hello extends Route
{
    public function __construct()
    {
        parent::__construct('hello', ':name?', ['GET']);
    }
}
