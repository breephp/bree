<?php

declare(strict_types=1);

namespace Bridget\Foundation;

use Bridget\Concretes\Container;

abstract class Application extends Container
{
    abstract public function run(): void;
}
