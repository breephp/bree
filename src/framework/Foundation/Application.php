<?php

declare(strict_types=1);

namespace Bree\Foundation;

use Bree\Concretes\Container;

abstract class Application extends Container
{
    abstract public function run(): void;
}
