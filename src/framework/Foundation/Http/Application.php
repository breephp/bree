<?php

declare(strict_types=1);

namespace Bridget\Foundation\Http;

use Bridget\Foundation\Application as BaseApplication;

class Application extends BaseApplication
{
    public function run(): void
    {
        echo '<p>Welcome to Bridget HTTP Application!</p>';
    }
}
