<?php

declare(strict_types=1);

namespace Bridget\Foundation\Cli;

use Bridget\Foundation\Application as BaseApplication;

class Application extends BaseApplication
{
    public function run(): void
    {
        echo 'Welcome to Bridget CLI Application!'.PHP_EOL;
    }
}
