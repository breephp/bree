<?php

declare(strict_types=1);

namespace Bree\Config;

abstract class AbstractLoader implements LoaderInterface
{
    public function __construct(string $root)
    {

        $this->setRoot($root);
    }
}
