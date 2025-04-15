<?php

declare(strict_types=1);

namespace Bree\Foundation\Http;

use Bree\Foundation\Application as BaseApplication;

class Application extends BaseApplication
{
    public function run(): void
    {
        echo '<p>Welcome to Bree HTTP Application!</p>';
    }
}
