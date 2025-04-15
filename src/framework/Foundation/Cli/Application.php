<?php

declare(strict_types=1);

namespace Bree\Foundation\Cli;

use Bree\Foundation\Application as BaseApplication;

class Application extends BaseApplication
{
    public function run(): void
    {
        echo 'Welcome to Bree CLI Application!'.PHP_EOL;
    }
}
